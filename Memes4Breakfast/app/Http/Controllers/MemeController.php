<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meme;
use App\Models\User;

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
