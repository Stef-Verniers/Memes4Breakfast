<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Inertia\Inertia;


// Import the Post model
class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return Inertia::render('Post/Index', ['posts' => $posts]);
    }
}
