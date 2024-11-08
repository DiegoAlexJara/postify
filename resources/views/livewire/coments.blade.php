<div>
    <h3>Comentarios</h3>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if ($comment)
        @foreach ($comment as $item)
            <div class="comment">
                <p class="comment-author">{{ $item->user->name }}</p>
                <p class="comment-text">{{ $item->content }}</p>
                @if (Auth::id() === $item->user_id)
                    <button wire:click="editar({{ $item->id }})" class="btn btn-warning">Editar</button>
                    <button wire:click="delete({{ $item->id }})" class="btn btn-danger">Eliminar</button>
                @endif
            </div>
            @if (isset($commentsUpdate[$item->id]) && $commentsUpdate[$item->id])
                <form class="comment-form" wire:submit.prevent='modificar({{ $item->id }})'>
                    <textarea name="comment" class="comment-input" wire:model='formData.content' placeholder="Escribe tu comentario..."></textarea>
                    <button type="submit" class="comment-submit">Modificar Comentario</button>
                </form>
            @endif
        @endforeach
    @endif

    @if ($view)
        <button class="btn" style="color: white !important" wire:click='viewComment'>Cancelar</button>
        <!-- Formulario para agregar comentario -->
        <form class="comment-form" wire:submit.prevent='submit'>
            <textarea name="comment" class="comment-input" wire:model='formData.content' placeholder="Escribe tu comentario..."
                required></textarea>

            <button type="submit" class="comment-submit">Añadir Comentario</button>
        </form>
    @else
        <button class="btn" style="color: white !important" wire:click='viewComment'>Nuevo Comentario</button>
    @endif
</div>
