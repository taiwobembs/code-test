<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->insert([
            'name' => 'Product 1',
            'description' => 'About product 1',
            'price' => '56.89',
            'image' => 'https://via.placeholder.com/150'
        ]);
        \DB::table('products')->insert([
            'name' => 'Product 2',
            'description' => 'About product 2',
            'price' => '156.89',
            'image' => 'https://via.placeholder.com/150'
        ]);
        \DB::table('products')->insert([
            'name' => 'Product 3',
            'description' => 'About product 3',
            'price' => '106.19',
            'image' => 'https://via.placeholder.com/150'
        ]);
        \DB::table('products')->insert([
            'name' => 'Product 4',
            'description' => 'About product 4',
            'price' => '46.29',
            'image' => 'https://via.placeholder.com/150'
        ]);
        \DB::table('products')->insert([
            'name' => 'Product 5',
            'description' => 'About product 5',
            'price' => '62.00',
            'image' => 'https://via.placeholder.com/150'
        ]);
    }
}
