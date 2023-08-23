<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ( $i=0;$i<25;$i++){
            DB::table('comments')->insert([
                'user_id' => 1,
                'comment_content' => Str::random(100),
                'created_at' => now()
            ]);
        }
    }
}
