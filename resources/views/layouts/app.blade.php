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

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.css" />

    <!-- Icono -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="d-flex align-items-center" style="background-color: #EAF1FF; height: 100dvh;">

    <!-- Contenido -->
    <main class="col-12 flex-wrap h-100">
        <!-- Navegacion -->
        <nav class="col-12 navbar navbar-white bg-white shadow-sm px-3">
            <div class="col-auto d-flex flex-wrap align-items-center justify-content-center">
                <!-- Icono -->
                <a href="{{ route('dashboard') }}" class="text-white h3 mb-0 p-2 rounded-3"
                    style="background: linear-gradient(139deg,#3341e8 0%, #9412f8 50%, #3341e8 100%);">
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
                    <button class="btn btn-sm btn-outline-danger"><i
                            class="fa-solid fa-arrow-right-from-bracket"></i></button>
                </form>
            @endauth
        </nav>
        <!-- Contenido -->
        @yield('content')
    </main>

    <!-- CDNs -->
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"
        integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>

    <!-- Select 2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>

    <!-- JS Generales -->
    @yield('scripts')

    <!-- Buscador de Usuarios y dispositivos -->
    <script>
        $(document).ready(function () {
            $('.select-teacher').select2({
                placeholder: 'Seleccione un usuario',
                allowClear: true,
                width: '100%'
            });

            $('.select-device').select2({
                placeholder: 'Seleccione un dispositivo',
                allowClear: true,
                width: '100%'
            });
        });
    </script>

    <!-- Switch -->
    <script>
        const toggleSection = (checkbox, showId, hideId) => {
            document.getElementById(showId).classList.toggle('d-none', !checkbox.checked);
            document.getElementById(hideId).classList.toggle('d-none', checkbox.checked);
        };

        const teacherSwitch = document.getElementById('useExistingTeacher');
        const deviceSwitch = document.getElementById('useExistingDevice');

        // Estado inicial (OFF)
        toggleSection(teacherSwitch, 'existingTeacher', 'newTeacher');
        toggleSection(deviceSwitch, 'existingDevice', 'newDevice');

        teacherSwitch.addEventListener('change', function () {
            toggleSection(this, 'existingTeacher', 'newTeacher');
        });

        deviceSwitch.addEventListener('change', function () {
            toggleSection(this, 'existingDevice', 'newDevice');
        });
    </script>

</body>

</html>