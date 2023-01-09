<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            ['id' => 1, 'name' => 'khaled', 'type' => 'super Admin', 'vendor_id' => 0, 'mobile' => '+97337645364',
              'email' => 'admin@admin.com', 'password' => '$2a$12$LthxzDYqpU5F5S.o2nS5iuzDkwwvah6.4BdhuHg1aZgOGisj83gNK', 
              'image' => '', 'status' => 0],
            // ['id' => 2, 'name' => 'khaled', 'type' => 'vendor', 'vendor_id' => 1, 'mobile' => '+97336798687',
            //   'email' => 'khaled@admin.com', 'password' => '$2a$12$LthxzDYqpU5F5S.o2nS5iuzDkwwvah6.4BdhuHg1aZgOGisj83gNK', 
            //   'image' => '', 'status' => 0],
        ];
        Admin::insert($adminRecords);

    }
}
