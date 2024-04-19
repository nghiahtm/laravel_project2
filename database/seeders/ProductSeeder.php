<?php

namespace Database\Seeders;

use App\Models\Manufacturers;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Product::factory()->count(15)
            ->has(Manufacturers::factory()->count(5), 'manufacturers')
            ->create();
//        Product::factory()->count(5)
//            ->hasManufacturers(8)
//            ->create();
//        Product::factory()->count(3)
//            ->create();
    }
}
