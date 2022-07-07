<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach ( range(1,10) as $index ) {
            DB::table('suppliers')->insert([
                'nama_supplier' => $faker->name(),
                // 'id_produk' => $faker->randomNumber(1, 15)
            ]);
        }
    }
}
