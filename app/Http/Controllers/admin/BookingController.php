<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Venue;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('admin');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'venue']);

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tanggal
        if ($request->has('date_from') && $request->date_from) {
            $query->where('booking_date', '>=', Carbon::parse($request->date_from));
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->where('booking_date', '<=', Carbon::parse($request->date_to));
        }

        // Filter berdasarkan venue
        if ($request->has('venue_id') && $request->venue_id) {
            $query->where('venue_id', $request->venue_id);
        }

        // Filter berdasarkan user
        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // Pencarian
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('event_name', 'like', "%{$search}%")
                    ->orWhere('event_description', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhereHas('venue', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $bookings = $query->latest()->paginate(10);
        $venues   = Venue::all();
        $users    = User::where('role', '!=', 'admin')->get();

        return view('admin.bookings.index', compact('bookings', 'venues', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $venues = Venue::all();
        $users  = User::where('role', '!=', 'admin')->get();
        return view('admin.bookings.create', compact('venues', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'           => 'required|exists:users,id',
            'venue_id'          => 'required|exists:venues,id',
            'booking_date'      => 'required|date|after_or_equal:today',
            'event_name'        => 'required|string|max:255',
            'event_description' => 'nullable|string',
            'status'            => 'required|in:pending,approved,rejected,cancelled',
        ]);

        // Cek ketersediaan venue pada tanggal tersebut
        $existingBooking = Booking::where('venue_id', $request->venue_id)
            ->where('booking_date', $request->booking_date)
            ->where('status', 'approved')
            ->exists();

        if ($existingBooking && $request->status == 'approved') {
            return back()->withInput()->with('error', 'Venue sudah dibooking pada tanggal tersebut.');
        }

        Booking::create([
            'user_id'           => $request->user_id,
            'venue_id'          => $request->venue_id,
            'booking_date'      => $request->booking_date,
            'event_name'        => $request->event_name,
            'event_description' => $request->event_description,
            'status'            => $request->status,
        ]);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking->load(['user', 'venue', 'venue.facilities', 'paymentDetail']);
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $venues = Venue::all();
        $users  = User::where('role', '!=', 'admin')->get();
        return view('admin.bookings.edit', compact('booking', 'venues', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'user_id'           => 'required|exists:users,id',
            'venue_id'          => 'required|exists:venues,id',
            'booking_date'      => 'required|date',
            'event_name'        => 'required|string|max:255',
            'event_description' => 'nullable|string',
            'status'            => 'required|in:pending,approved,rejected,cancelled',
        ]);

        // Cek ketersediaan venue pada tanggal tersebut (kecuali booking ini sendiri)
        $existingBooking = Booking::where('venue_id', $request->venue_id)
            ->where('booking_date', $request->booking_date)
            ->where('status', 'approved')
            ->where('id', '!=', $booking->id)
            ->exists();

        if ($existingBooking && $request->status == 'approved') {
            return back()->withInput()->with('error', 'Venue sudah dibooking pada tanggal tersebut.');
        }

        $booking->update([
            'user_id'           => $request->user_id,
            'venue_id'          => $request->venue_id,
            'booking_date'      => $request->booking_date,
            'event_name'        => $request->event_name,
            'event_description' => $request->event_description,
            'status'            => $request->status,
        ]);

        return redirect()->route('admin.bookings.show', $booking)
            ->with('success', 'Booking berhasil diperbarui.');
    }

    /**
     * Update the status of the specified booking.
     */
    public function updateStatus(Booking $booking)
    {
        $booking->update([
            'status' => 'approved',
        ]);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Status booking berhasil diperbarui.');
    }

    public function rejectBooking(Booking $booking)
    {
        $booking->update([
            'status' => 'rejected',
        ]);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Status booking berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        // Hapus payment detail jika ada
        if ($booking->paymentDetail) {
            $booking->paymentDetail->delete();
        }

        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil dihapus.');
    }

    /**
     * Display calendar view of bookings.
     */
    public function calendar()
    {
        $bookings = Booking::with(['user', 'venue'])
            ->where('booking_date', '>=', Carbon::now()->subMonths(1))
            ->where('booking_date', '<=', Carbon::now()->addMonths(2))
            ->get();

        return view('admin.bookings.calendar', compact('bookings'));
    }

    /**
     * Get bookings for calendar (JSON).
     */
    public function getCalendarEvents()
    {
        $bookings = Booking::with(['user', 'venue'])
            ->where('booking_date', '>=', Carbon::now()->subMonths(1))
            ->where('booking_date', '<=', Carbon::now()->addMonths(2))
            ->get();

        $events = [];

        foreach ($bookings as $booking) {
            $color = '';
            switch ($booking->status) {
                case 'pending':
                    $color = '#F59E0B'; // yellow
                    break;
                case 'approved':
                    $color = '#10B981'; // green
                    break;
                case 'rejected':
                    $color = '#EF4444'; // red
                    break;
                case 'cancelled':
                    $color = '#6B7280'; // gray
                    break;
            }

            $events[] = [
                'id'              => $booking->id,
                'title'           => $booking->venue->name . ' - ' . $booking->event_name,
                'start'           => $booking->booking_date->format('Y-m-d'),
                'url'             => route('admin.bookings.show', $booking),
                'backgroundColor' => $color,
                'borderColor'     => $color,
            ];
        }

        return response()->json($events);
    }
}
