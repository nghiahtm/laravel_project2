<?php

namespace Database\Seeders;

use App\Models\Manufacturers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManufacturersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Manufacturers::factory()->count(15)->create();
    }
}
