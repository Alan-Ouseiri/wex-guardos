<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistema de Responsivas')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v7.1.0/css/all.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

</head>

<body class="d-flex align-items-center" style="background-color: #EAF1FF; height: 100dvh;">

    <main class="col-12 flex-wrap h-100">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
                .forEach(el => new bootstrap.Tooltip(el));
        });
    </script>
</body>

</html>