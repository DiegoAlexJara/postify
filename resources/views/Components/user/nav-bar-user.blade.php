<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('UsuarioInicio', ['name'=>Auth::user()->name]) }}">
            <img src="https://png.pngtree.com/png-clipart/20230330/original/pngtree-sticky-notes-png-image_9011267.png"
                alt="" style="height: 30px; width: 30px;">{{ Auth::user()->name }}</a>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('Inicio') }}">INICIO</a>
                </li>
            </ul>
        </div>
        <div class="btn-group dropstart" role="group">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Opciones
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="#">Another action</a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item" href="#">Another action</a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form action="{{ route('outLog') }}" method="POST" style="margin: 10px">
                        @csrf
                        <button class="dropdown-item" type="submit">Salir</button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</nav>
