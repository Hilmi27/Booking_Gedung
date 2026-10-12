<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\PaymentDetail;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bookings = auth()->user()->bookings()
            ->with('venue')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $venues = Venue::all();
        return view('bookings.create', compact('venues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'venue_id'          => 'required|exists:venues,id',
            'booking_date'      => 'required|date|after_or_equal:today',
            'event_name'        => 'required|string|max:255',
            'event_description' => 'nullable|string',
        ]);

        $venue = Venue::findOrFail($request->venue_id);

        // Check if venue is available on the requested date
        if (! $venue->isAvailableOn($request->booking_date)) {
            return back()->with('error', 'Gedung tidak tersedia pada tanggal yang dipilih.');
        }

        $booking = Booking::create([
            'user_id'           => auth()->id(),
            'venue_id'          => $request->venue_id,
            'booking_date'      => $request->booking_date,
            'event_name'        => $request->event_name,
            'event_description' => $request->event_description,
            'total_price'       => $venue->price_per_day,
            'status'            => 'pending',
        ]);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking berhasil dibuat. Silakan lakukan pembayaran.');
    }

    public function show(Booking $booking)
    {
        // Make sure user can only see their own bookings
        if ($booking->user_id !== auth()->id() && ! auth()->user()->isAdmin()) {
            abort(403);
        }

        $booking->load('venue');
        $paymentDetails = PaymentDetail::active()->get();

        return view('bookings.show', compact('booking', 'paymentDetails'));
    }

    public function uploadPayment(Request $request, Booking $booking)
    {
        // Make sure user can only update their own bookings
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'payment_proof' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('payment_proof')) {
            // Delete old payment proof if exists
            if ($booking->payment_proof) {
                Storage::delete('public/' . $booking->payment_proof);
            }

            // Store new payment proof
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');

            // Update booking
            $booking->update([
                'payment_proof' => $path,
                'payment_date'  => now(),
            ]);

            return redirect()->route('bookings.show', $booking)
                ->with('success', 'Bukti pembayaran berhasil diupload.');
        }

        return back()->with('error', 'Gagal mengupload bukti pembayaran.');
    }

    public function destroy(Booking $booking)
    {
        // Make sure user can only cancel their own bookings
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        // Only pending bookings without payment can be cancelled
        if ($booking->status !== 'pending' || $booking->payment_proof) {
            return back()->with('error', 'Booking tidak dapat dibatalkan.');
        }

        $booking->update([
            'status'           => 'cancelled',
            'rejection_reason' => 'Dibatalkan oleh pengguna',
        ]);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking berhasil dibatalkan.');
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'venue_id' => 'required|exists:venues,id',
            'date'     => 'required|date',
        ]);

        $venue     = Venue::findOrFail($request->venue_id);
        $available = $venue->isAvailableOn($request->date);

        return response()->json([
            'available' => $available,
        ]);
    }
}
