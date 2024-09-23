<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario Nuevo</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    {{-- Boostrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</head>

<body>
    <div class="content">

        <form action="{{ route('CrearUsuario') }}" method="POST">
            @csrf
            <h2>Nueva Cuenta</h2>
            NOMBRE
            <div class="mb-3">
                <label for="">
                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                </label>
                @error('name')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            CORREO
            <div class="mb-3">
                <label for="">
                    <input type="email" name="email" id="email" value="{{ old('email') }}">
                </label>
                @error('email')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            CONTRASEÑA
            <div class="mb-3">
                <label for="">
                    <input type="password" name="password" id="password" value="{{ old('password') }}">
                </label>
                @error('password')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            CONFIRMAR CONTRASEÑA:
            <div class="mb-3">
                <label for="password_confirmation">
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </label>
                @error('password')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">
                    <input type="submit" value="CREAR CUENTA">
                </label>
            </div>
        </form>
        <a href="{{ route('login') }}" class="btn btn-primary">REGRESAR</a>

    </div>
</body>

</html>