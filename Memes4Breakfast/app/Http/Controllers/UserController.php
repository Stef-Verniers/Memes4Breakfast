<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Get all users
    public function index() {
        $users = User::all();
        return view('home', [
            'users' => $users
        ]);
    }
}
