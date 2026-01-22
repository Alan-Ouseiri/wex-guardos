<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistema de Responsivas')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v7.1.0/css/all.css">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body style="background-color: #EAF1FF;">

    <!-- Navegacion -->
    <nav class="navbar navbar-white bg-white shadow-sm px-3">
        <div class="col-8 d-flex flex-wrap align-items-center justify-content-center">
            <!-- Icono -->
            <a href="{{ route('dashboard') }}" class="text-white h3 mb-0 p-2 rounded-3" style="background-color: #4F39F6;">
                <i class="fa-regular fa-file-lines"></i>
            </a>

            <!-- Titulo -->
            <div class="flex-fill ms-2">
                <p class="h4 mb-0"><b>Sistema de Responsivas</b></p>
                <span style="font-size: 12px;">Gestión de dispositivos y documentos</span>
            </div>
        </div>

        @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
        </form>
        @endauth
    </nav>

    <!-- Contenido -->
    <div class="container mt-4">
        @yield('content')
    </div>


    <!-- CDNs -->
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>

    <!-- Select 2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- JS Generales -->
    <!-- Buscador de Usuarios -->
    <script>
        $(document).ready(function() {
            $('.select-teacher').select2({
                placeholder: 'Seleccione un usuario',
                allowClear: true,
                width: '100%'
            });
        });
    </script>

    <!-- Tooltip -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
                .forEach(el => new bootstrap.Tooltip(el));
        });
    </script>

</body>

</html>