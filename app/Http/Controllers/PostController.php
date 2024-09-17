<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\post;

class PostController extends Controller
{
    public function store(Request $request)
    {

        // Toto esto se puede validar con un try catch, para esperar errores
        try {
            $user_id = Auth::id();
            $validatedData = $request->validate([
                'content' => 'required|string|min:1|max:5000',
                'title' => 'required|string|min:5|max:255',
            ]);
            $post = new Post();
            $post->content = $validatedData['content'];
            $post->user_id  = $user_id;
            $post->title = $validatedData['title'];
            $post->save();
            return redirect()->route('Inicio')->with('success', 'Publicacion Creada');
        } catch (\Exception $e) {
            // Reportamos el error
            report($e);

            // Retornamos a la vista con un mensaje de session con el error
            return redirect()->route('Inicio')->with('error', 'Error al crear la publicacion');
        }
    }
    public function update(Request $request, $postId)
    {

        try {
            $validatedData = $request->validate([
                'content' => 'required|string|min:1|max:5000',
                'title' => 'required|string|min:5|max:255',
            ]);

            // El metodo update retorna un boleano, si el false significa que no se pudo actualizar el registo.
            // Mandar un mensaje de error si no se actualizo el registro
            if (!Post::find($postId)->update([
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'user_id' => Auth::user()->id,
            ])) return redirect()->route('Inicio')->with('error', 'Error al modificar la publicacion');


            return redirect()->route('Inicio')->with('success', 'Publicacion Modificada');
        } catch (\Exception $e) {
            report($e);
            return redirect()->route('Inicio')->with('error', 'Error al modificar la publicacion');
        }
    }
}
