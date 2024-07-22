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

    // Create a new user
    public function create(Request $r) {
        // COMING SOON
    }
}
