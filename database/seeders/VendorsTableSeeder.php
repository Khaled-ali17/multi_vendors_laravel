<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\vendor;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $vendorRecords=[
            ['id' => 1 , 'name' => 'khaled', 'address' => '325', 'city' => 'Manama' , 'state' => 'Manama' , 
            'country' => 'bahrain' , 'pincode' => '111397', 'mobile' => '+97336598735' , 'email' => 'khaled@admin.com', 'status' => 0]
        ];

        Vendor::insert($vendorRecords);
    }
}
