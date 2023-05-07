<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Merchant::updateOrCreate(
            [
                'email' => "abdullahzahidjoy@gmail.com"
            ],
            [
                'owner_name' => "Abdullah zahid joy",
                'owner_pic' => "upload/merchant/pic/221218063121-2483.jpg",
                'password' => Hash::make('123456'),
                'nid' => '123456789123',
                'owner_contact' => '123456789123',
                'merchant_name' => 'joy2362',
                'merchant_logo' => "upload/merchant/logo/221218063121-2483.jpg",
                'email_verified_at' => now(),
            ]
        );
    }
}
