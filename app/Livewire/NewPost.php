<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

use function Pest\Laravel\post;

class NewPost extends Component
{
    public $view = false;
    public $update = false;
    public $viewUpdate = false;
    public $title;
    public $content;
    public $updatePost = [];

    public $formData = [
        'content' => '',
        'title' => ''
    ];

    public function render()
    {
        $posts = Post::all();

        return view('livewire.new-post', ['posts' => $posts]);
    }

    function submit()
    {
        $this->validate([
            'formData.content' => 'required',
            'formData.title' => 'required',
        ], [
            'formData.content.required' => 'El contenido es requerido',
            'formData.title.required' => 'El titulo es requerido',
        ]);


        if (!Post::create([
            "content" => $this->formData['content'],
            "user_id" => Auth::id(),
            "title" => $this->formData['title']
        ])) {
            session()->flash('message', 'Error Al Crear Publicacion');
        } else {

            session()->flash('message', 'Publicacion Creada');

            $this->reset('formData');
            $this->view = false;
            $this->update = false;
            $this->render();
        }
    }

    function toggleUpdate($id)
    {
        
        if (isset($this->update[$id])) {
            
            $this->update[$id] = !$this->update[$id];

            if ($this->update[$id]) {
                $post = Post::find($id);
    
                if ($post) {
                    $this->formData = [
                        'content' => $post->content, // Asigna el contenido inicial
                        'title' => $post->title
                    ];
                } else {
                    // Maneja el caso en que el post no se encuentra
                    $this->formData = [
                        'content' => '',
                        'title' => ''
                    ];
                }
            }
        } 
        else {
            $this->update[$id] = true;
        }
    }

    function delete($post_id)
    {

        $post = Post::find($post_id);
        if ($post->delete()) {
            session()->flash('message', 'Publicacion Eliminada');
            return;
        } else {
            session()->flash('message', 'Publicacion No Eliminada');
        }

    }
    function ActualizarPost($id)
    {

        $post = Post::find($id);
        $validacion = $this->validate([
            'formData.content' => 'required',
            'formData.title' => 'required',
        ], [
            'formData.content.required' => 'El contenido es requerido',
            'formData.title.required' => 'El titulo es requerido',
        ]);

        if(!$post->update([
            'content' => $this->formData['content'],
            'title' => $this->formData['title'],
        ]))
        {
            session()->flash('message', 'No Se pudo Actualizar');
        }else
        {
            session()->flash('message', 'Se Actualizo La publicacion');
        }
        $this->reset('formData');
        $this->update = false;
        $this->view = false;
        $this->render();
        

    }
}
