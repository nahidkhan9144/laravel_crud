<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UpdateUserPasswordsSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->password = Hash::make('123'); // Replace '123' with the actual password
            $user->save();
        }
    }
}
