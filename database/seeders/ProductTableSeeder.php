<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $productRecords = [
            [
                'id' => 1,
                'section_id' => 2,
                'category_id' => 5,
                'brand_id' => 6,
                'vendor_id' => 1,
                'admin_id'=> 1,
                'admin_type' => 'vendor',
                'product_name' => 'Redmi Note 11',
                'product_code' => 'RN11',
                'product_color' => 'Black',
                'product_price' => '100 BHD',
                'product_discount' => '10',
                'product_weight' => '400',
                'product_image' => '',
                'product_video' => '',
                'description' => '',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'is_featured' => 'Yes',
                'status' => 1
            ],
            [
                'id' => 2,
                'section_id' => 1,
                'category_id' => 1,
                'brand_id' => 1,
                'vendor_id' => 0,
                'admin_id'=> 2,
                'admin_type' => 'superadmin',
                'product_name' => 'Green T-shirt',
                'product_code' => 'GRT112',
                'product_color' => 'Green',
                'product_price' => '5 BHD',
                'product_discount' => '5',
                'product_weight' => '200',
                'product_image' => '',
                'product_video' => '',
                'description' => '',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'is_featured' => 'Yes',
                'status' => 1
            ],
        ];

        Product::insert($productRecords);
    }
}