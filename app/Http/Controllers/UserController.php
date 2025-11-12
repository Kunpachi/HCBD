<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'johndoe@user.com', 'verified' => false],
            ['id' => 2, 'name' => 'Hilda Rocha', 'email' => 'poqeqoxy@mailinator.com', 'verified' => false],
            ['id' => 3, 'name' => 'Guest', 'email' => 'guest@guest.com', 'verified' => false],
        ];

        return view('users.index', compact('users'));
    }
}
