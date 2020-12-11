<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom border-top" style="z-index: 2;box-shadow: 5px 0px 7px rgba(200,200,200,.4);">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fa fa-home text-primary"></i> Inicio <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('estadisticas') }}">
                    <i class="fas fa-chart-bar"></i> Estadísticas
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-shopping-cart"></i> Compras
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('getAllCompras') }}">Transacciones</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="cargarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-tasks"></i> Cargar
                </a>
                <div class="dropdown-menu" aria-labelledby="cargarDropdown">
                    <a class="dropdown-item" href="{{ route('cargarProductos') }}">Productos</a>
                    <a class="dropdown-item" href="#">Cupones</a>
                    <a class="dropdown-item" href="{{ route('categorias') }}">Categoria</a>
                </div>
            </li>
        </ul>
    </div>
</nav>