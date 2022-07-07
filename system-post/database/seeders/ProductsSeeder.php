<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach( range(1,15) as $index ) {
            DB::table('products')->insert([
                'nama_produk' => $faker->word(1),
                'stok' => $faker->randomNumber(2),
                'harga' => $faker->randomNumber(4)
            ]);
        }
    }
}
