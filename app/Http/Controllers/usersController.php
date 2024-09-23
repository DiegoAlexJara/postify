<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class usersController extends Controller
{

    public function index()
    {
        // $posts = Post::orderBy('created_at', 'asc')->get();

        $posts = Post::orderBy('created_at', 'desc')->get();
        // $posts = Post::all(); 
        return view('User.index', compact('posts'));
    }

    // Este metodo recibe como parametro desde la uri la variable name, recibirla como un string en este metodo
    public function Inicio() // (string $name)
    {
        return view('User.login');
    }

    public function search()
    {
        
    }
}
