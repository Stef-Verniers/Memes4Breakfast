<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meme;

class MemeController extends Controller
{
    public function index () {
        $memes = Meme::all();
        return view('home', [
            'memes' => $memes
        ]);
    }
}
