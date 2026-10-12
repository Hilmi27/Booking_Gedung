<?php

namespace Database\Seeders;

use App\Models\PaymentDetail;
use Illuminate\Database\Seeder;

class PaymentDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentDetails = [
            [
                'bank_name' => 'Bank BCA',
                'account_number' => '1234567890',
                'account_name' => 'PT Seni Indonesia',
                'is_active' => true,
            ],
            [
                'bank_name' => 'Bank Mandiri',
                'account_number' => '0987654321',
                'account_name' => 'PT Seni Indonesia',
                'is_active' => true,
            ],
            [
                'bank_name' => 'Bank BNI',
                'account_number' => '1122334455',
                'account_name' => 'PT Seni Indonesia',
                'is_active' => true,
            ],
        ];

        foreach ($paymentDetails as $paymentDetail) {
            PaymentDetail::create($paymentDetail);
        }
    }
}