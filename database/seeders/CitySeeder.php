<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Pastikan baris ini ditambahkan

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            ['name' => 'Jakarta'],
            ['name' => 'Bogor'],
            ['name' => 'Bekasi'],
        ]);
    }
}
