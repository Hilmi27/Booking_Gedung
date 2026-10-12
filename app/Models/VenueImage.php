<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenueImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'venue_id',
        'image_path',
        'is_primary',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_primary' => 'boolean',
    ];

    /**
     * Get the venue that owns the image.
     */
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    /**
     * Set this image as primary and unset others.
     */
    public function setAsPrimary()
    {
        // Begin transaction
        \DB::beginTransaction();

        try {
            // Unset all other primary images for this venue
            VenueImage::where('venue_id', $this->venue_id)
                ->where('id', '!=', $this->id)
                ->update(['is_primary' => false]);

            // Set this image as primary
            $this->is_primary = true;
            $this->save();

            // Commit transaction
            \DB::commit();
            
            return true;
        } catch (\Exception $e) {
            // Rollback transaction
            \DB::rollback();
            
            return false;
        }
    }
}