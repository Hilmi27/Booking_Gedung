<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'capacity',
        'price_per_day',
        'image',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price_per_day' => 'decimal:2',
    ];

    /**
     * Get all facilities for the venue.
     */
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'venue_facility');
    }

    /**
     * Get all images for the venue.
     */
    public function images()
    {
        return $this->hasMany(VenueImage::class);
    }

    /**
     * Get all bookings for the venue.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the primary image for the venue.
     */
    public function getPrimaryImage()
    {
        $primaryImage = $this->images()->where('is_primary', true)->first();
        
        if ($primaryImage) {
            return $primaryImage->image_path;
        }
        
        // If no primary image is set, return the first image or default
        $firstImage = $this->images()->first();
        return $firstImage ? $firstImage->image_path : $this->image;
    }

    /**
     * Check if the venue is available on a specific date.
     */
    public function isAvailableOn($date)
    {
        return !$this->bookings()
            ->where('booking_date', $date)
            ->whereIn('status', ['approved', 'pending'])
            ->exists();
    }

    /**
     * Get all available dates for the venue within a date range.
     */
    public function getAvailableDates($startDate, $endDate)
    {
        $bookedDates = $this->bookings()
            ->whereBetween('booking_date', [$startDate, $endDate])
            ->whereIn('status', ['approved', 'pending'])
            ->pluck('booking_date')
            ->map(function ($date) {
                return $date->format('Y-m-d');
            })
            ->toArray();

        $allDates = [];
        $currentDate = new \DateTime($startDate);
        $endDateTime = new \DateTime($endDate);

        while ($currentDate <= $endDateTime) {
            $dateString = $currentDate->format('Y-m-d');
            $allDates[$dateString] = !in_array($dateString, $bookedDates);
            $currentDate->modify('+1 day');
        }

        return $allDates;
    }
}