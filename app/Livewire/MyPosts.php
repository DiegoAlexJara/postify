<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyPosts extends Component
{
    public $userId;
    public $update = false;
    public $viewUpdate = false;
    public $view = false;
    public $updatePost = [];

    public $formData = [
        'content' => '',
        'title' => ''
    ];

    function mount($userId)
    {

        $this->userId = $userId;
    }

    public function render()
    {

        $posts = Post::where('user_id', $this->userId)->get();

        return view('livewire.my-posts', ['posts' => $posts]);
    }

    function viewCreate()
    {
        $this->view = !$this->view;
        $this->reset('formData');
        $this->update = false;
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
            return;
        }

        session()->flash('message', 'Publicacion Creada');

        $this->reset('formData');
        $this->view = false;
        // $this->update = false;
        $this->render();
    }
    function delete($postId)
    {
        $post = Post::find($postId);

        if (!$post->delete()) {
            session()->flash('message', 'Publicacion No Eliminada');
            return;
        }
        session()->flash('message', 'Publicacion Eliminada');
    }

    function toggleUpdate($id)
    {
        if (!isset($this->update[$id])) {
            $this->update[$id] = true;
            $this->view = false;

            if (!$this->update[$id]) return;

            $post = Post::find($id);
            if (!$post) {
                $this->formData = [
                    'content' => '',
                    'title' => ''
                ];
                return;
            }

            $this->formData = [
                'content' => $post->content, // Asigna el contenido inicial
                'title' => $post->title
            ];
            return;
        }

        if($this->update[$id]) return;
        
        $this->update[$id] = !$this->update[$id];
        $this->view = false;

        if (!$this->update[$id]) return;

        $post = Post::find($id);

        if (!$post) {
            $this->formData = [
                'content' => '',
                'title' => ''
            ];
            return;
        }

        $this->formData = [
            'content' => $post->content, // Asigna el contenido inicial
            'title' => $post->title
        ];
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

        if (!$post->update([
            'content' => $this->formData['content'],
            'title' => $this->formData['title'],
        ])) {
            session()->flash('message', 'No Se pudo Actualizar');
            return;
        }

        session()->flash('message', 'Se Actualizo La publicacion');

        $this->reset('formData');
        $this->update = false;
        $this->view = false;
        $this->render();
    }

}
