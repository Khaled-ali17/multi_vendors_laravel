<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorBusinessDetail;

class VendorBusinessDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $vendorBusinessDetailRecords = [
            ['id' => 1 , 'vendor_id' => 1 , 'shop_name' => 'Electronics__' , 'shop_address' => 'Block 234 , Road 1234 , Manama' , 'shop_city' => 'Manama',
              'shop_country' => 'Bahrain', 'shop_state' => 'Manama', 'shop_pincode' => '111986', 'shop_mobile' => '+97336754987', 'shop_email' => 'electronics@gmail.com',
              'business_license_number' => '123467786', 'address_proof' => 'passport' , 'address_proof_image' => 'img.jpeg', 'gst_number' => '9755329' , 'pen_number' => '45678899'
            ],
        ];

        VendorBusinessDetail::insert($vendorBusinessDetailRecords);
    }
}
