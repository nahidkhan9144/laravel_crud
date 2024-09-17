<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordUpdateController extends Controller
{
    public function updatePasswords()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->password = Hash::make('123'); // Replace '123' with the actual password
            $user->save();
        }

        return 'Passwords updated successfully.';
    }
}

