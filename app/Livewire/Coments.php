<?php

namespace App\Livewire;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

use function Pest\Laravel\post;

class Coments extends Component
{

    public $postId;
    public $comments;
    public $view = false;
    public $commentsUpdate = [];

    public $formData = [
        'content' => ''
    ];

    function mount($postId)
    {

        $this->postId = $postId;
    }

    // #[On('test-event')]
    // function onTestEvent($text)  {
    //     dd($text);
    // }


    public function render()
    {
        $comment = Comment::where('post_id', $this->postId)->get();
        return view('livewire.coments', ['comment' => $comment]);
    }

    function submit()
    {
        $this->validate([
            'formData.content' => 'required',
        ], [
            'formData.content.required' => 'El contenido es requerido',
        ]);
        $user = Auth::user()->id;
        if (!Comment::create([
            'content' => $this->formData['content'],
            'post_id' => $this->postId,
            'user_id' => $user,
        ])) {
            session()->flash('error', 'No Se Puede Crear Comentario');
            return;
        }
        session()->flash('success', 'Comentario Creado');
        $this->reset('formData');
        $this->view = false;
    }

    function delete($comment)
    {

        if (!$comment = Comment::find($comment)) {
            session()->flash('success', 'Comentario No Encontrado');
            return;
        }

        if (!$comment->delete()) {
            session()->flash('success', 'Comentario No Eliminado');
        }


        session()->flash('success', 'Comentario Eliminado');
    }
    function editar($commentId)
    {   
        $this->view = false;
        if (!isset($this->commentsUpdate[$commentId])) {

            $this->commentsUpdate[$commentId] = true;

            if (!$this->commentsUpdate[$commentId]) return;

            $comment = Comment::find($commentId);

            if (!$comment) {
                $this->formData = [
                    'content' => '',
                ];
                return;
            }
            $this->formData = [
                'content' => $comment->content,
            ];
            return;
        }
        $this->commentsUpdate[$commentId] = !$this->commentsUpdate[$commentId];

        if (!$this->commentsUpdate[$commentId]) return;

        $comment = Comment::find($commentId);

        if (!$comment) {
            $this->formData = [
                'content' => '',
            ];
            return;
        }
        $this->formData = [
            'content' => $comment->content,
        ];
    }

    function viewComment()
    {

        $this->view = !$this->view;
        $this->commentsUpdate = false;
        $this->formData = [
            'content' => '',
        ];
    }
    function modificar($commentId)
    {

        if (!$comment = Comment::find($commentId)) {
            session()->flash('error', 'No Se Puede Modificar');
        }

        $this->validate([
            'formData.content' => 'required',
        ], [
            'formData.content.required' => 'El contenido es requerido',
        ]);

        if (!$comment->update([
            'content' => $this->formData['content'],
        ])) {
            session()->flash('error', 'No Se pudo Actualizar');
            return;
        }
        session()->flash('success', 'Se Actualizo El Comentario');

        $this->reset('formData');
        $this->commentsUpdate[$commentId] = false;
        $this->view = false;
    }
}
