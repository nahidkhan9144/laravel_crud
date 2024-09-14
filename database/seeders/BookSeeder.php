<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('books')->insert([
                'title' => 'Book Title ' . $i,
                'author' => 'Author ' . $i,
                'description' => 'This is the description of book ' . $i,
                'published_date' => now(),
            ]);
        }
    }
}
