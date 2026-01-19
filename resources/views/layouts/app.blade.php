<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistema de Responsivas')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v7.1.0/css/all.css">
</head>

<body style="background-color: #EAF1FF;">

    <nav class="navbar navbar-white bg-white shadow-sm px-3">
        <div class="col-8 d-flex flex-wrap align-items-center justify-content-center">
            <!-- Icono -->
            <span class="text-white h3 mb-0 p-2 rounded-3" style="background-color: #4F39F6;">
                <i class="fa-regular fa-file-lines"></i>
            </span>

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

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>