<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Venue;
use App\Models\VenueImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VenueController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('admin');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venues = Venue::with('facilities')->get();
        return view('admin.venues.index', compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $facilities = Facility::all();
        return view('admin.venues.create', compact('facilities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'required|string',
            'capacity'      => 'required|integer|min:1',
            'price_per_day' => 'required|numeric|min:0',
            'images.*'      => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'facilities'    => 'array',
            'facilities.*'  => 'exists:facilities,id',
        ]);

        // Create venue
        $venue = Venue::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'capacity'      => $request->capacity,
            'price_per_day' => $request->price_per_day,
        ]);

        // Attach facilities
        if ($request->has('facilities')) {
            $venue->facilities()->attach($request->facilities);
        }

        // Handle images
        $images = $request->allFiles()['images'] ?? [];
        if (! empty($images)) {
            $isPrimary        = true; // First image is primary
            $primaryImagePath = null;

            // Create venues directory if it doesn't exist
            $venuesPath = public_path('assets/venues');
            if (! file_exists($venuesPath)) {
                mkdir($venuesPath, 0755, true);
            }

            foreach ($images as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/venues'), $filename);
                $imagePath = 'assets/venues/' . $filename;

                // Save to venue_images table
                VenueImage::create([
                    'venue_id'   => $venue->id,
                    'image_path' => $imagePath,
                    'is_primary' => $isPrimary,
                ]);

                // Store first image as primary for venues table
                if ($isPrimary) {
                    $primaryImagePath = $imagePath;
                }

                $isPrimary = false; // Only first image is primary
            }

            // Update venues table with primary image
            if ($primaryImagePath) {
                $venue->update(['image' => $primaryImagePath]);
            }
        }

        return redirect()->route('admin.venues.index')
            ->with('success', 'Gedung berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venue $venue)
    {
        $venue->load('facilities', 'images');
        $facilities = Facility::all();

        return view('admin.venues.edit', compact('venue', 'facilities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venue $venue)
    {

        $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'required|string',
            'capacity'      => 'required|integer|min:1',
            'price_per_day' => 'required|numeric|min:0',
            'images.*'      => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'facilities'    => 'array',
            'facilities.*'  => 'exists:facilities,id',
            'primary_image' => 'nullable|exists:venue_images,id',
        ]);

        // Update venue
        $venue->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'capacity'      => $request->capacity,
            'price_per_day' => $request->price_per_day,
        ]);

        // Sync facilities
        $venue->facilities()->sync($request->facilities ?? []);

        // Handle images
        $images = $request->allFiles()['images'] ?? [];
        if (! empty($images)) {
            $newPrimaryImagePath = null;

            // Create venues directory if it doesn't exist
            $venuesPath = public_path('assets/venues');
            if (! file_exists($venuesPath)) {
                mkdir($venuesPath, 0755, true);
            }

            foreach ($images as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/venues'), $filename);
                $imagePath = 'assets/venues/' . $filename;

                VenueImage::create([
                    'venue_id'   => $venue->id,
                    'image_path' => $imagePath,
                    'is_primary' => false,
                ]);

                // Store first new image path
                if ($newPrimaryImagePath === null) {
                    $newPrimaryImagePath = $imagePath;
                }
            }

            // Update venues table if new images were added
            if ($newPrimaryImagePath && ! $venue->image) {
                $venue->update(['image' => $newPrimaryImagePath]);
            }
        }

        // Set primary image
        if ($request->has('primary_image')) {
            $primaryImage = VenueImage::find($request->primary_image);
            if ($primaryImage && $primaryImage->venue_id === $venue->id) {
                $primaryImage->setAsPrimary();
            }
        }

        return redirect()->route('admin.venues.index', $venue)
            ->with('success', 'Gedung berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        // Check if venue has bookings
        if ($venue->bookings()->exists()) {
            return back()->with('error', 'Gedung tidak dapat dihapus karena memiliki booking.');
        }

        // Delete venue images
        foreach ($venue->images as $image) {
            $imagePath = public_path($image->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete venue
        $venue->delete();

        return redirect()->route('admin.venues.index')
            ->with('success', 'Gedung berhasil dihapus.');
    }

    /**
     * Remove the specified image.
     */
    public function destroyImage(VenueImage $image)
    {
        $venueId = $image->venue_id;

        // Check if it's the only image
        $imageCount = VenueImage::where('venue_id', $venueId)->count();
        if ($imageCount <= 1) {
            return back()->with('error', 'Tidak dapat menghapus satu-satunya gambar gedung.');
        }

        // If it's primary image, set another image as primary
        if ($image->is_primary) {
            $newPrimary = VenueImage::where('venue_id', $venueId)
                ->where('id', '!=', $image->id)
                ->first();

            if ($newPrimary) {
                $newPrimary->setAsPrimary();
            }
        }

        // Delete image file
        $imagePath = public_path($image->image_path);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete image record
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}
