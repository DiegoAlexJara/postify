<div class="container">

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif


    @if ($view)
        
        <div class="form-post">
            <form wire:submit.prevent="submit">
                <div class="mb-3">
                    <input type="text" wire:model="formData.title" id="title" placeholder="Titulo"
                        style="background-color: rgba(255, 255, 255, 0); color:white">
                    @error('formData.title')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <textarea class="form-control" id="content" wire:model="formData.content" rows="3"
                        placeholder="Nueva Publicación" resize="none" maxlength="1000" minlength="1" oninput="updateCharCount()"
                        style="background-color: rgba(255, 255, 255, 0); color:white"></textarea>
                    <p style="color:white" id="contador">1000 Caracteres Restantes</p>
                    @error('formData.content')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <div style="display: flex">
                        <button class="btn btn-warning" style="margin-right: 12%; margin-left: 12%" 
                        wire:click='viewCreate'>CANCELAR</button>
                        <button type="submit" class="btn btn-primary">CREAR</button>
                    </div>
                </div>
            </form>
        </div>
    @else
        <div class="mb-3">
            <button class="btn btn-dark" style="display: block; margin: 0 auto;" wire:click='viewCreate'>CREAR
                PUBLICACION</button>
        </div>
    @endif

    @foreach ($posts as $registros)
        <div class="post">
            <h2 class="post-title">{{ $registros->title }}</h2>
            <p class="post-author">Escrito por <strong>{{ $registros->user->name }}</strong></p>
            <p class="post-content">{{ $registros->content }}</p>

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

                @livewire('Coments', ['postId' => $registros->id], key($registros->id))

            </div>
        </div>
    @endforeach


    <script>
        function testEvent(text) {
            Livewire.dispatch('test-event', text);
        }

        function updateCharCount() {
            // Obtener el valor del campo de texto
            const inputTexto = document.getElementById('texto');

            // Filtrar solo letras (sin contar números, espacios ni caracteres especiales)
            const soloLetras = inputTexto.value.replace(/[^a-zA-Z]/g, ''); // Solo letras del alfabeto

            // Calcular la longitud de las letras y actualizar el contador
            const cantidadLetras = soloLetras.length;

            // Mostrar la cantidad de caracteres en el elemento contador
            const contador = document.getElementById('contador');
            contador.value = cantidadLetras;
        }
    </script>


</div>
