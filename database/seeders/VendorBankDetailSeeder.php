<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorBankDetail;

class VendorBankDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $vendorBankDetailRecords = [
            [
                'id' => 1, 'vendor_id' => 1,'acount_holder_name' => 'khaled ali','bank_name' => 'BBK','acount_number' => '085567542567',
                'bank_ifsc_code' => '234567897',
            ],
        ];

        VendorBankDetail::insert($vendorBankDetailRecords);
    }
}
