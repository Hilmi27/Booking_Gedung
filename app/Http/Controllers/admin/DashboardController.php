<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik dasar
        $venueCount = Venue::count();
        $userCount = User::where('role', '!=', 'admin')->count();
        $bookingCount = Booking::count();
        $pendingBookingCount = Booking::where('status', 'pending')->count();
        $approvedBookingCount = Booking::where('status', 'approved')->count();
        
        // Booking terbaru untuk tabel pertama
        $recentBookings = Booking::with('user', 'venue')
            ->latest()
            ->take(5)
            ->get();
        
        // Booking mendatang untuk tabel kedua
        $upcomingBookings = Booking::with('user', 'venue')
            ->where('booking_date', '>=', Carbon::today())
            ->where('status', 'approved')
            ->orderBy('booking_date')
            ->take(5)
            ->get();
        
        // Booking untuk kalender
        $calendarBookings = Booking::with('user', 'venue')
            ->where('booking_date', '>=', Carbon::today()->subMonths(1))
            ->where('booking_date', '<=', Carbon::today()->addMonths(2))
            ->where('status', 'approved')
            ->orWhere('status', 'pending')
            ->get();
        
        return view('admin.dashboard', compact(
            'venueCount', 
            'userCount', 
            'bookingCount', 
            'pendingBookingCount',
            'approvedBookingCount',
            'recentBookings',
            'upcomingBookings',
            'calendarBookings'
        ));
    }
}