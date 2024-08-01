<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meme;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MemeController extends Controller
{
    // We load all our memes with the corresponding user data
    public function index () {
        $memes = Meme::with('user')->get();
        return view('home', [
            'memes' => $memes
        ]);
    }

    // upload page
    public function upload() {
        // Declare a variable to get the logged in user (or not)
        $user = Auth::user();
        // Redirect not authenticated users to the login page because non-auths can't post
        if (!$user) {
            return view('auth/login');
        }
        // if authenticated, the user will be proceeded to the upload page
        return view('/upload');
    }

    // Create (or upload) a meme
    public function create(Request $req) {
        
        // validate request and declare rules
        $req->validate([
            'caption' => 'required',
            'meme' => 'required|mimes:jpg,jpeg,png,gif|max:6000'    
        ]);

        // Rename the uploaded file for a better name convention
        $rename = 1 . "_" . date('Y-m-d' . '_' .  'H-i-s') . "." . $req->meme->extension();
        
        // Move and store the file to a public directory
        $req->meme->move(public_path('uploads'), $rename);

        // Store the meme to the database
        $meme = Meme::create([
            'caption' => $req->input('caption'),
            'meme' => $rename,
            'user_id' => 100
        ]);

        return redirect('/');
    }
}
