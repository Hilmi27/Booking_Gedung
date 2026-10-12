<?php
namespace App\Http\Controllers;

use App\Models\Venue;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::with('images', 'facilities')->get();
        return view('venues.index', compact('venues'));
    }

    public function show(Venue $venue)
    {
        $venue->load('images', 'facilities');

        // Get available dates for the next 30 days
        $startDate      = now()->format('Y-m-d');
        $endDate        = now()->addDays(30)->format('Y-m-d');
        $availableDates = $venue->getAvailableDates($startDate, $endDate);

        return view('venues.show', compact('venue', 'availableDates'));
    }
}
