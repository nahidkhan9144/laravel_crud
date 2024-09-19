<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    protected $signature = 'users:update-passwords';
    protected $description = 'Update all users\' passwords to a hashed version';

    public function run(): void
    {

        for ($i = 1; $i <= 100; $i++) {
            DB::table('books')->insert([
                'title' => 'Book Title ' . $i,
                'author' => 'Author ' . $i,
                'description' => 'This is the description of book ' . $i,
                'published_date' => now(),
            ]);
        }
    }
}
