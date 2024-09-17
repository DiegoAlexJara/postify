<div>
    @if ($view)
        <div style="text-align: right">
            <button class="btn btn-danger" wire:click='delete'>Eliminar post</button>
            <button class="btn btn-warning" wire:click='$toggle("update_view")'>Modificar post</button>
        </div>
    @endif

    @if ($update_view)
        {{-- Trabaja los formularios desde el controlador del componete --}}
        {{-- wire:submit y wire:model --}}
        <form action="{{ route('pots.update', $this->postId) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3" style="text-align: center">
                <input style="width: 400px" type="text" name="title" id="title" placeholder="Titulo"
                    value="{{ $post->title }}">
                @error('title')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <textarea class="form-control" id="content1" name="content1" rows="3" placeholder="Nueva Publicación"
                    resize="none" maxlength="1000" minlength="1" oninput="updateCharCount()">{{ $post->content }}</textarea>
                <p id="charCount1">1000 Caracteres Restantes</p>
                @error('content')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    @endif

</div>
