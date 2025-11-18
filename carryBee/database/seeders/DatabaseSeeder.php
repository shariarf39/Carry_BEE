<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Hub;
use App\Models\KmaList;
use App\Models\Catagories;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create user (only if not exists)
        User::firstOrCreate(
            ['email' => 'shariarfahim21@gmail.com'],
            [
                'name' => 'Shariar Fahim',
                'password' => Hash::make('11223344'),
                'phone' => '01234567890',
            ]
        );

        // Create admin (only if not exists)
        Admin::firstOrCreate(
            ['email' => 'shariarfahim21@gmail.com'],
            [
                'name' => 'Shariar Fahim',
                'password' => Hash::make('11223344'),
            ]
        );

        // Create Pick Up Hubs
        $hubs = [
            'Dhaka - Mirpur',
            'Dhaka - Gulshan',
            'Dhaka - Dhanmondi',
            'Dhaka - Uttara',
            'Chittagong Hub',
            'Sylhet Hub',
            'Rajshahi Hub',
            'Khulna Hub',
            'Barisal Hub',
            'Rangpur Hub',
        ];

        foreach ($hubs as $hub) {
            Hub::create([
                'name' => $hub,
                'location' => $hub,
                'is_active' => true,
            ]);
        }

        // Create KAM List
        $kams = [
            'Md. Kamal Hossain',
            'Farida Rahman',
            'Tanvir Ahmed',
            'Nusrat Jahan',
            'Rashid Khan',
            'Sadia Islam',
            'Imran Hossain',
            'Anika Sultana',
        ];

        foreach ($kams as $kam) {
            KmaList::create([
                'name' => $kam,
            ]);
        }

        // Create Product Categories
        $categories = [
            'Electronics',
            'Fashion & Apparel',
            'Books & Stationery',
            'Food & Grocery',
            'Health & Beauty',
            'Home & Kitchen',
            'Sports & Outdoors',
            'Toys & Games',
            'Jewelry & Accessories',
            'Automotive',
        ];

        foreach ($categories as $category) {
            Catagories::create([
                'name' => $category,
            ]);
        }
    }
}
