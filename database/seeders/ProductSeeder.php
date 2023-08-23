<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ( $i=0;$i<25;$i++){
            DB::table('products')->update([
                'product_image' => "970.jpg",
                'product_price' => random_int(100,1000),
                'product_brand_id' => 368,
                'product_category_id' => 366,
                'product_description' => Str::random(500),
                'product_date' => now()
            ]);
        }

    }
}
