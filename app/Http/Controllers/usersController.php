<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

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

    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'like', "%$query%")->get();
        return view('User.search', compact('users', 'query'));
    }

    public function visit(String $name)
    {

        $user = User::where('name', $name)->first(); // Obtiene el primer usuario que coincida con el nombre

        if ($user) { // Verifica que el usuario exista
            $userId = $user->id; // Accede a la propiedad id
            return view('User.visit', compact('userId', 'name')); // Pasa el ID a la vista
        } else {
            // Manejar el caso en que no se encuentra el usuario
            return redirect()->back()->with('error', 'Usuario no encontrado.');
        }
        // $user = User::where('name', $name)->first();
        // $user = $user->id();
        // return view('User.visit', compact('user'));
        // return name;
    }
}
