<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure the payment proofs directory exists
        $directory = public_path('storage/payment_proofs');
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
        
        // Create sample payment proof
        $this->createSamplePaymentProof();
        
        $users = User::where('role', 'user')->get();
        $venues = Venue::all();
        $statuses = ['pending', 'approved', 'rejected', 'cancelled'];
        $eventTypes = ['Konser', 'Pameran', 'Workshop', 'Seminar', 'Pertunjukan', 'Festival', 'Rapat'];
        
        // Generate 20 bookings
        for ($i = 0; $i < 20; $i++) {
            $user = $users->random();
            $venue = $venues->random();
            $status = $statuses[array_rand($statuses)];
            $eventType = $eventTypes[array_rand($eventTypes)];
            
            // Generate random dates
            $bookingDate = Carbon::now()->addDays(rand(1, 90))->format('Y-m-d');
            $createdAt = Carbon::now()->subDays(rand(1, 30));
            
            $bookingData = [
                'user_id' => $user->id,
                'venue_id' => $venue->id,
                'booking_date' => $bookingDate,
                'event_name' => $eventType . ' ' . $user->name,
                'event_description' => 'Deskripsi acara ' . $eventType . ' yang diselenggarakan oleh ' . $user->name,
                'status' => $status,
                'total_price' => $venue->price_per_day,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
            
            // Add status-specific data
            if ($status === 'approved') {
                $bookingData['payment_proof'] = 'payment_proofs/sample_payment.jpg';
                $bookingData['payment_date'] = Carbon::parse($bookingDate)->subDays(rand(1, 10));
            } elseif ($status === 'rejected') {
                $rejectionReasons = [
                    'Gedung sudah dibooking pada tanggal tersebut',
                    'Dokumen tidak lengkap',
                    'Pembayaran tidak sesuai',
                    'Acara tidak sesuai dengan ketentuan'
                ];
                $bookingData['rejection_reason'] = $rejectionReasons[array_rand($rejectionReasons)];
            }
            
            Booking::create($bookingData);
        }
    }
    
    /**
     * Create a sample payment proof image
     */
    private function createSamplePaymentProof(): void
    {
        $path = public_path('storage/payment_proofs/sample_payment.jpg');
        
        if (!File::exists($path)) {
            // Create a simple image as placeholder
            $image = imagecreatetruecolor(800, 1000);
            
            // Background color
            $bgColor = imagecolorallocate($image, 240, 240, 240);
            imagefill($image, 0, 0, $bgColor);
            
            // Text colors
            $textColor = imagecolorallocate($image, 50, 50, 50);
            $headerColor = imagecolorallocate($image, 0, 100, 200);
            
            // Add header
            imagestring($image, 5, 300, 50, "BUKTI TRANSFER", $headerColor);
            
            // Add details
            imagestring($image, 4, 100, 150, "Tanggal: " . date('Y-m-d'), $textColor);
            imagestring($image, 4, 100, 200, "Waktu: " . date('H:i:s'), $textColor);
            imagestring($image, 4, 100, 250, "Dari: 1234567890", $textColor);
            imagestring($image, 4, 100, 300, "Ke: 0987654321", $textColor);
            imagestring($image, 4, 100, 350, "Bank: BCA", $textColor);
            imagestring($image, 4, 100, 400, "Jumlah: Rp 3.000.000", $textColor);
            imagestring($image, 4, 100, 450, "Status: BERHASIL", $headerColor);
            
            // Add border
            $borderColor = imagecolorallocate($image, 200, 200, 200);
            imagerectangle($image, 50, 100, 750, 500, $borderColor);
            
            // Save the image
            imagejpeg($image, $path, 90);
            imagedestroy($image);
        }
    }
}