<?php
namespace Database\Seeders;

use App\Models\Venue;
use App\Models\VenueImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure the venue images directory exists
        $directory = public_path('storage/venues');
        if (! File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Create venues
        $venues = [
            [
                'name'          => 'Gedung Serbaguna Utama',
                'description'   => 'Gedung serbaguna dengan kapasitas besar, cocok untuk pertunjukan musik, teater, dan acara besar lainnya.',
                'capacity'      => 500,
                'price_per_day' => 5000000,
                'image'         => 'venues/gedung1.jpg',
                'facilities'    => [1, 2, 3, 4, 6, 7, 9, 10], // IDs of facilities
                'images'        => [
                    ['image_path' => 'assets/venues/venue1_image1.jpg', 'is_primary' => true],
                    ['image_path' => 'assets/venues/venue1_image2.jpg', 'is_primary' => false],
                    ['image_path' => 'assets/venues/venue1_image3.jpg', 'is_primary' => false],
                ],
            ],
            [
                'name'          => 'Teater Kecil',
                'description'   => 'Teater intim dengan akustik yang sempurna, ideal untuk pertunjukan teater kecil dan musik akustik.',
                'capacity'      => 150,
                'price_per_day' => 2500000,
                'image'         => 'venues/teater1.jpg',
                'facilities'    => [1, 2, 4, 5, 6, 7, 8],
                'images'        => [
                    ['image_path' => 'assets/venues/venue2_image1.jpg', 'is_primary' => true],
                    ['image_path' => 'assets/venues/venue2_image2.jpg', 'is_primary' => false],
                    ['image_path' => 'assets/venues/venue2_image3.jpg', 'is_primary' => false],
                ],
            ],
            [
                'name'          => 'Ruang Pameran',
                'description'   => 'Ruang pameran luas dengan pencahayaan yang baik, cocok untuk pameran seni dan fotografi.',
                'capacity'      => 200,
                'price_per_day' => 3000000,
                'image'         => 'venues/pameran1.jpg',
                'facilities'    => [3, 6, 9, 10],
                'images'        => [
                    ['image_path' => 'assets/venues/venue3_image1.jpg', 'is_primary' => true],
                    ['image_path' => 'assets/venues/venue3_image2.jpg', 'is_primary' => false],
                ],
            ],
            [
                'name'          => 'Aula Tari',
                'description'   => 'Aula dengan lantai kayu khusus untuk pertunjukan tari dan latihan.',
                'capacity'      => 100,
                'price_per_day' => 2000000,
                'image'         => 'venues/aula1.jpg',
                'facilities'    => [1, 2, 5, 6, 7],
                'images'        => [
                    ['image_path' => 'assets/venues/venue4_image1.jpg', 'is_primary' => true],
                    ['image_path' => 'assets/venues/venue4_image2.jpg', 'is_primary' => false],
                    ['image_path' => 'assets/venues/venue4_image3.jpg', 'is_primary' => false],
                ],
            ],
            [
                'name'          => 'Auditorium Musik',
                'description'   => 'Auditorium dengan akustik yang dirancang khusus untuk konser musik klasik dan kontemporer.',
                'capacity'      => 300,
                'price_per_day' => 4000000,
                'image'         => 'venues/auditorium1.jpg',
                'facilities'    => [1, 2, 4, 5, 6, 7, 9, 10],
                'images'        => [
                    ['image_path' => 'assets/venues/venue5_image1.jpg', 'is_primary' => true],
                    ['image_path' => 'assets/venues/venue5_image2.jpg', 'is_primary' => false],
                ],
            ],
        ];

        // Create sample image files if they don't exist
        $this->createSampleImages();

        foreach ($venues as $venueData) {
            $facilityIds = $venueData['facilities'];
            $images      = $venueData['images'];

            unset($venueData['facilities']);
            unset($venueData['images']);

            $venue = Venue::create($venueData);

            // Attach facilities
            $venue->facilities()->attach($facilityIds);

            // Create venue images
            foreach ($images as $image) {
                VenueImage::create([
                    'venue_id'   => $venue->id,
                    'image_path' => $image['image_path'],
                    'is_primary' => $image['is_primary'],
                ]);
            }
        }
    }

    /**
     * Create sample image files for venues
     */
    private function createSampleImages(): void
    {
        $directory = public_path('storage/venues');

        // Sample colors for placeholder images
        $colors = ['#FF5733', '#33FF57', '#3357FF', '#F3FF33', '#FF33F3'];

        // Create sample images for each venue
        for ($i = 1; $i <= 5; $i++) {
            $color = $colors[$i - 1];

            for ($j = 1; $j <= 3; $j++) {
                $filename = "venue{$i}_image{$j}.jpg";
                $path     = $directory . '/' . $filename;

                if (! File::exists($path)) {
                    // Create a simple colored image as placeholder
                    $image = imagecreatetruecolor(800, 600);

                    // Convert hex color to RGB
                    $r = hexdec(substr($color, 1, 2));
                    $g = hexdec(substr($color, 3, 2));
                    $b = hexdec(substr($color, 5, 2));

                    $colorResource = imagecolorallocate($image, $r, $g, $b);
                    imagefill($image, 0, 0, $colorResource);

                    // Add some text
                    $textColor = imagecolorallocate($image, 255, 255, 255);
                    $text      = "Venue {$i} - Image {$j}";
                    imagestring($image, 5, 300, 280, $text, $textColor);

                    // Save the image
                    imagejpeg($image, $path, 90);
                    imagedestroy($image);
                }
            }

            // Also create the main venue image
            $mainImageNames = ['gedung1.jpg', 'teater1.jpg', 'pameran1.jpg', 'aula1.jpg', 'auditorium1.jpg'];
            $mainImagePath  = $directory . '/' . $mainImageNames[$i - 1];

            if (! File::exists($mainImagePath)) {
                // Create a simple colored image as placeholder
                $image = imagecreatetruecolor(800, 600);

                // Convert hex color to RGB
                $r = hexdec(substr($color, 1, 2));
                $g = hexdec(substr($color, 3, 2));
                $b = hexdec(substr($color, 5, 2));

                $colorResource = imagecolorallocate($image, $r, $g, $b);
                imagefill($image, 0, 0, $colorResource);

                // Add some text
                $textColor = imagecolorallocate($image, 255, 255, 255);
                $text      = "Main Image - " . substr($mainImageNames[$i - 1], 0, -4);
                imagestring($image, 5, 300, 280, $text, $textColor);

                // Save the image
                imagejpeg($image, $mainImagePath, 90);
                imagedestroy($image);
            }
        }
    }
}
