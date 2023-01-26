<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $sectionRecordes = [
            ['id' => 1 , 'name' => 'Clothes' , 'status' => 1],
            ['id' => 2 , 'name' => 'Electronics' , 'status' => 1],
            ['id' => 3 , 'name' => 'Appiances' , 'status' => 1],
        ];

        Section::insert($sectionRecordes);
    }
}
