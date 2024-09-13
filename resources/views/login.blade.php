<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INGRESAR</title>
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

        <form class="mb-3" method="POST" action="{{ route('login') }}">

            @session('error')
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endsession

            @csrf

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">CORREO ELECTRONICO</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                    value="{{ old('email') }}">
                @error('email')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                @error('password')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">INGRESAR</button>
            </div>

        </form>

        <a href="{{ route('NuevoUsuario') }}" class="mb-3">CREAR USUARIO</a>

    </div>
</body>

</html>
