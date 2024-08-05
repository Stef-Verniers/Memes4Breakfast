<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avatar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Haal de user op uit de sessie (indien aanwezig)
        $user = $request->user(); 
        return view('dashboard', compact('user'));
    }

    public function choose() 
    {
        $user = Auth::user();
        $avatars = Avatar::all()->where('is_exclusive', '=' , 0);
        dd($avatars);
    }

}