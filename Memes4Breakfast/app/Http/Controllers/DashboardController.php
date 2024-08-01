<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Haal de user op uit de sessie (indien aanwezig)
        $user = $request->user(); 
        return view('dashboard', compact('user'));
    }
}