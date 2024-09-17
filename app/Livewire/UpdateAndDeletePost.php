<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function Pest\Laravel\post;

class UpdateAndDeletePost extends Component
{
    public $view = false;
    public $postId = '';
    public $name_user = '';
    public $user;
    public $update_view = false;
    public $post;
    

    public function mount($postId, $name_user)
    {
        $user = Auth::user()->name;
        $this->postId = $postId;
        $this->post = Post::find($postId);
        $this->name_user = $name_user;
        $this->view = $name_user === $user;
        // dd($postId, $name_user, $view, $user);

    }
    public function delete()
    {
        $post = Post::find($this->postId);
        $post->delete(); 
        return redirect()->route('Inicio')->with('success', 'Publicacion Eliminada');
    }
    
    public function render()
    {
        return view('livewire.update-and-delete-post');
    }
}
