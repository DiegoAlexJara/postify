<div class="container">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="mb-3">
        <button class="btn btn-light" style="display: block; margin: 0 auto;" wire:click='$toggle("view")'>CREAR
            PUBLICACION</button>
    </div>


    @if ($view)
        <div class="form-post">
            <form wire:submit.prevent="submit">
                <div class="mb-3">
                    <input type="text" wire:model="formData.title" id="title" placeholder="Titulo">
                    @error('formData.title')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <textarea class="form-control" id="content" wire:model="formData.content" rows="3"
                        placeholder="Nueva Publicación" resize="none" maxlength="1000" minlength="1" oninput="updateCharCount()"></textarea>
                    <p id="charCount">1000 Caracteres Restantes</p>
                    @error('formData.content')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">CREAR</button>
                </div>
            </form>
        </div>
    @endif

    @foreach ($posts as $registros)
        <div class="post">
            <h2 class="post-title">{{ $registros->title }}</h2>
            <p class="post-author">Escrito por <strong>{{ $registros->user->name }}</strong></p>
            <p class="post-content">{{ $registros->content }}</p>
            {{-- @livewire('UpdateAndDeletePost', ['postId' => $registros->id, 'name_user' => $registros->user->name], key($registros->id))@livewire('UpdateAndDeletePost', ['postId' => $registros->id, 'name_user' => $registros->user->name], key($registros->id))@livewire('UpdateAndDeletePost', ['postId' => $registros->id, 'name_user' => $registros->user->name], key($registros->id))@livewire('UpdateAndDeletePost', ['postId' => $registros->id, 'name_user' => $registros->user->name], key($registros->id)) --}}

            @if (Auth::user()->name === $registros->user->name)
                <div style="text-align: right">
                    <button class="btn btn-danger" wire:click='delete({{ $registros->id }})'>Eliminar post</button>
                    <button class="btn btn-warning" wire:click='toggleUpdate({{ $registros->id }})'>Modificar
                        post</button>
                </div>
            @endif
            @if (isset($update[$registros->id]) && $update[$registros->id])
                <div class="form-post">
                    <form wire:submit.prevent="ActualizarPost({{ $registros->id }})">
                        <div class="mb-3">
                            <input type="text" wire:model="formData.title" id="title" placeholder="Titulo">
                            @error('formData.title')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="content" wire:model="formData.content" rows="3"
                                placeholder="Nueva Publicación" resize="none" maxlength="1000" minlength="1" oninput="updateCharCount()"></textarea>
                            <p id="charCount">1000 Caracteres Restantes</p>
                            @error('formData.content')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
                        </div>
                    </form>
                    
                    </form>
                </div>
            @endif

            <!-- Sección de comentarios -->
            <div class="comments">
                <h3>Comentarios</h3>

                <!-- Comentarios existentes -->
                <div class="comment">
                    <p class="comment-author">Autor del comentario 1</p>
                    <p class="comment-text">Este es el comentario número 1.</p>
                </div>

                <!-- Formulario para agregar comentario -->
                <form class="comment-form" action="#" method="post">
                    <textarea name="comment" class="comment-input" placeholder="Escribe tu comentario..." required></textarea>
                    <button type="submit" class="comment-submit">Añadir Comentario</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
