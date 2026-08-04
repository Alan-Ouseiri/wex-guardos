@extends('layouts.app')

@section('title', 'Ver Responsiva')

@section('content')

    <!-- Atras -->
    <div class="col-12 d-flex mt-4">
        <a href="{{ route('responsivas.index') }}" class="boton-desplegable">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="texto-animado">Atrás</span>
        </a>
    </div>

    <!-- Contenido -->
    <div class='d-flex justify-content-center mt-3 pb-5'>
        <div class="col-xxl-7 col-xl-9 col-11 d-flex flex-wrap">

            <!-- Izquierda -->
            <div class="col-md-7 col-12 pe-md-3 pe-0 pb-md-0 pb-3">
                <div class="col-12 bg-gradient-cyan rounded-4" style="padding: 1px;">
                    <div class="col-12 bg-white rounded-4 p-3">

                        <!-- Titulo -->
                        <div class="border-bottom pb-3 mb-3">
                            <h2 class="fw-bold text-blue mb-0">
                                {{ $responsiva->responsiva_number }}
                            </h2>
                            <span class="text-secondary" style="font-size: 14px;">
                                Ve a detalle todos los datos de la Responsiva
                            </span>
                        </div>

                        <!-- Responsiva -->
                        <div class="col-12">
                            <p class="mb-0"><b>Fecha de asignacion:</b>
                                {{ date('d-m-Y', strtotime($responsiva->assigned_date)) }}
                            </p>
                            <p class="mb-0"><b>Condicion de entrega:</b> {{ $responsiva->condition }}
                            </p>
                            <p class="mb-0"><b>Ubicacion:</b> {{ $responsiva->location }}</p>
                            <p class="mb-0"><b>Entregó con:</b> {{ $responsiva->delivered_by }}</p>
                            <p class="mb-0"><b>Estatus:</b> {{ $responsiva->status }}</p>
                        </div>

                        <!-- Dispositivo -->
                        <div class="col-12 pt-4">
                            <!-- Cabecera -->
                            <div class="col-12">
                                <h4 class="fw-bold text-teal">
                                    Dispositivo asignado
                                </h4>
                            </div>

                            <!-- Contenido -->
                            <div class="col-12 mt-2">
                                <p class="mb-0"><b>Tipo:</b> {{ $responsiva->device->type }}</p>
                                <p class="mb-0"><b>Marca:</b> {{ $responsiva->device->brand }}</p>
                                <p class="mb-0"><b>Modelo:</b> {{ $responsiva->device->model }}</p>
                                <p class="mb-0"><b>No. Serie:</b>
                                    {{ $responsiva->device->serial_number }}
                                </p>
                            </div>
                        </div>

                        <!-- Usuario -->
                        <div class="col-12 pt-4">

                            <!-- Cabecera -->
                            <div class="col-12">
                                <h4 class="fw-bold text-orange">
                                    Usuario que se le asigno
                                </h4>
                            </div>

                            <!-- Contenido -->
                            <div class="col-12 mt-2">
                                <p class="mb-0"><b>Nombre:</b> {{ $responsiva->teacher->full_name }}
                                </p>
                                <p class="mb-0"><b>Email:</b> {{ $responsiva->teacher->email }}</p>
                                <p class="mb-0"><b>Rol:</b> {{ $responsiva->teacher->role }}</p>
                                @if (isset($responsiva->teacher->employee_number))
                                    <p class="mb-0"><b>No. Empleado:</b>
                                        {{ $responsiva->teacher->employee_number }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Derecha -->
            <div class="col-xl-4 col-md-5 col-12 ps-md-3 ps-0 pt-md-0 pt-3">
                <!-- Acciones -->
                <div class="col-12 bg-secondary rounded-4" style="padding: 1px;">
                    <div class="col-12 bg-white rounded-4 p-3">

                        <!-- Cabecera -->
                        <div class="col-12">
                            <h4 class="fw-bold text-secondary mb-0">
                                Acciones
                            </h4>
                        </div>

                        <!-- Contenido -->
                        <div class="col-12 row mt-3">
                            <!-- Devolver -->
                            @if ($responsiva->status === 'Activa')
                                <button class="col-auto mb-2 text-primary" style="background: none; border: none;"
                                    data-bs-toggle="modal" data-bs-target="#returnModal{{ $responsiva->id }}">
                                    <i class="fa-solid fa-arrow-rotate-left"></i> Devolver Dispositivo
                                </button>
                            @endif

                            <!-- Imprimir -->
                            <a href="{{ route('responsivas.pdf', $responsiva) }}" class="text-decoration-none mb-2">
                                <i class="fa-solid fa-print"></i> Imprimir
                            </a>

                            <!-- Editar -->
                            @if ($responsiva->status === 'Activa')
                                <a href="{{ route('responsivas.edit', $responsiva) }}" class="text-decoration-none mb-2">
                                    <i class="fa-solid fa-pen"></i> Editar
                                </a>
                            @endif

                            <!-- Historial -->
                            <a href="{{ route('responsivas.history', $responsiva) }}" class="text-decoration-none mb-2">
                                <i class="fa-solid fa-clock-rotate-left"></i> Ver Historial
                            </a>

                            <!-- Correo -->
                            @if ($responsiva->status === 'Activa' && $responsiva->teacher->email)
                                @php
                                    $to = rawurlencode($responsiva->teacher->email);

                                    $subject = rawurlencode(
                                        'Responsiva de ' . $responsiva->device->description
                                    );

                                    $body = rawurlencode(
                                        "Estimado(a) {$responsiva->teacher->name} {$responsiva->teacher->surname},\n\n" .
                                        "Por medio del presente se le informa la asignación del siguiente dispositivo, el cual queda bajo su resguardo:\n\n" .
                                        "Dispositivo: {$responsiva->device->description}\n" .
                                        "Número de serie: {$responsiva->device->serial_number}\n" .
                                        "Folio de responsiva: {$responsiva->responsiva_number}\n\n" .
                                        "En caso de tener cualquier duda, aclaración o requerir apoyo adicional, puede acudir directamente al área de Cultura Digital o comunicarse al correo electrónico info.culturadigital@wexford.edu.mx.\n\n" .
                                        "Agradecemos su atención y colaboración.\n" .
                                        "Atentamente,\n" .
                                        "Cultura Digital\n" .
                                        "Colegio Wexford"
                                    );

                                    $gmailUrl =
                                        "https://mail.google.com/mail/?view=cm&fs=1&to={$to}&su={$subject}&body={$body}";
                                @endphp

                                <a href="{{ $gmailUrl }}" class="text-decoration-none">
                                    <i class="fa-solid fa-envelope"></i> Mandar Correo electrónico al Usuario
                                </a>
                            @endif

                            <!-- Eliminar -->
                            @if ($responsiva->status != 'Activa')
                                <button style="background: none; border: none;" data-bs-toggle="modal"
                                    class="col-auto text-primary mb-2" data-bs-target="#deleteModal{{ $responsiva->id }}">
                                    <i class="fa-regular fa-trash-can"></i>
                                    Eliminar Responsiva
                                </button>
                            @endif

                            <!-- Reasignar -->
                            @if ($responsiva->status != 'Activa')
                                <div class="col-12">

                                    <button style="background: none; border: none;" data-bs-toggle="modal"
                                        class="col-auto text-primary text-no-wrap"
                                        data-bs-target="#reassignModal{{ $responsiva->id }}">
                                        <i class="fa-solid fa-person-walking-arrow-loop-left"></i>
                                        Reasiganar Dispositivo
                                    </button>
                                </div>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="returnModal{{ $responsiva->id }}">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('responsivas.return', $responsiva) }}">
                @csrf
                @method('PUT')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa-solid fa-circle-exclamation text-danger"></i> Confirmación de devolución de equipo
                        </h5>
                    </div>

                    <div class="modal-body">
                        <span>
                            Le informamos que el proceso de devolución de dispositivo es definitivo. Al confirmar, el
                            sistema pondra disponible el equipo y no será posible deshacer esta operación.
                        </span>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button class="btn btn-danger">
                            Confirmar devolución
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Eliminar -->
    <div class="modal fade" id="deleteModal{{ $responsiva->id }}">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text-danger">Eliminar Responsiva</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    ¿Seguro que deseas enviar esta responsiva a la papelera?
                    <br>
                    <strong>{{ $responsiva->responsiva_number }}</strong>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <form method="POST" action="{{ route('responsivas.destroy') }}">
                        @csrf
                        <input type="text" name="val" id="val" class="d-none" value="{{ $responsiva->id }}">
                        <button class="btn btn-danger">
                            Sí, eliminar
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Reasignar -->
    <div class="modal fade" id="reassignModal{{ $responsiva->id }}">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text-primary">Reasignar Dispositivo</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    El proceso de <b>Reasignar</b> toma el mismo <b>Usuario</b> y el mismo <b>Dispositivo</b> para crear una
                    <b>Nueva Responsiva</b> con
                    la <b>Fecha Actual</b>, se usaran los datos como Condicion y Localizacion de esta Responsiva.
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <form method="POST" action="{{ route('responsivas.reassign') }}">
                        @csrf
                        <input type="text" name="val" id="val" class="d-none" value="{{ $responsiva->id }}">
                        <button class="btn btn-primary">
                            Crear
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection