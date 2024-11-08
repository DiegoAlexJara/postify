<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Searck</title>
    <link rel="icon" href="{{ asset('img/postify.webp   ') }}" type="image/x-icon">


    {{-- ESTILOS --}}
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">

</head>

<body>

    <nav class="navbar">
        <div class="container">
            <!-- Enlace con imagen para regresar -->
            <a href="{{ route('Inicio') }}" class="dropdown-item">
                <img src="{{ asset('img/return.png') }}" alt="Regresar" class="return-icon">
            </a>

            <!-- Formulario de búsqueda de usuario -->
            <form action="{{ route('BuscarUser') }}" method="GET" class="search-form">
                <input type="text" name="query" id="query" placeholder="Usuario" class="input-text" required>
                <input type="submit" value="Buscar" class="submit-btn">
            </form>
        </div>
    </nav>
    <div class="results-container">
        @if (isset($users) && $users->count())
            @if (isset($query))
                <h2>Resultados para: "{{ $query }}"</h2>
            @endisset
            
            <div class="user-cards">
                @foreach ($users as $user)
                    <div class="user-card">
                        <h3>{{ $user->name }}</h3>
                        <p>Email: {{ $user->email }}</p>
                        <p>Registrado el: {{ $user->created_at->format('d-m-Y') }}</p>
                        <a href="{{ route('visit', $user->name) }}" class="view-button">Ver Usuario</a>
                    </div>
                @endforeach
            </div>
        @else
            <h2>No se encontraron resultados para: "{{ $query }}"</h2>
        @endif
</div>
</body>

</html>
