<?php

namespace Database\Seeders;

use App\Models\Reseller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ResellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reseller::updateOrCreate(
            [
                'email' => "abdullahzahidjoy@gmail.com"
            ],
            [
                'reseller_name' => "Abdullah zahid joy",
                'profile_pic' => "upload/reseller/pic/221218063121-2483.jpg",
                'password' => Hash::make('123456'),
                'nid' => '123456789123',
                'contact' => '123456789123',
                'email_verified_at' => now(),
            ]
        );
    }
}
