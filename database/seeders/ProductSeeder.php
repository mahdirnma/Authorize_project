<?php

namespace Database\Seeders;

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
        Product::create([
            'title' => 'product 1',
            'description' => 'lorem 1',
            'price' => '100000',
            'category_id' => 1,
        ]);
        Product::create([
            'title' => 'product 2',
            'description' => 'lorem 2',
            'price' => '200000',
            'category_id' => 2,
        ]);
    }
}
