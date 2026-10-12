<?php
namespace App\Http\Controllers;

use App\Models\Venue;

class HomeController extends Controller
{
    public function index()
    {
        $featuredVenues = Venue::with('images', 'facilities')
            ->take(1)
            ->get();

        return view('home', compact('featuredVenues'));
    }
}
