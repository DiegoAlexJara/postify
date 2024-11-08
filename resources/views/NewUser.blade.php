<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario Nuevo</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="icon" href="{{ asset('img/postify.webp   ') }}" type="image/x-icon">


    {{-- Boostrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</head>

<body>
    <div class="login">
    <div class="content">

        <form action="{{ route('CrearUsuario') }}" method="POST">
            @csrf
            <h2 style="color: rgb(143, 143, 143); margin-bottom:20px;">Nueva Cuenta</h2>
            <div class="mb-3">
                <label for="">
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Nombre" required
                    style="background-color: rgba(0, 0, 0, 0); color: rgb(143, 143, 143); font-size: 18px;">
                </label>
                @error('name')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="">
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Correo" required
                    style="background-color: rgba(0, 0, 0, 0); color: rgb(143, 143, 143); font-size: 18px;">
                </label>
                @error('email')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">
                    <input type="password" name="password" id="password" value="{{ old('password') }}"placeholder="Contraseña" required
                    style="background-color: rgba(0, 0, 0, 0); color: rgb(143, 143, 143); font-size: 18px;">
                </label>
                @error('password')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation">
                    <input type="password" id="password_confirmation" name="password_confirmation" required 
                    placeholder="Confirmar Contraseña"
                    style="background-color: rgba(0, 0, 0, 0); color: rgb(143, 143, 143); font-size: 18px;">
                </label>
                @error('password')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">
                    <button class="btn btn-dark" type="submit">CREAR CUENTA</button>
                </label>
            </div>
        </form>
        <a href="{{ route('login') }}" class="btn btn-primary">REGRESAR</a>

    </div>
    </div>
</body>

</html>