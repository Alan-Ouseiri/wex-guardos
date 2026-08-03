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
        <div class="col-xl-8 col-lg-10 col-12 d-flex flex-wrap">

            <!-- Izquierda -->
            <div class="col-lg-6 col-12">

                <!-- Responsiva -->
                <div class="pe-3 pb-3">
                    <div class="col-12 bg-gradient-cyan rounded-4 shadow" style="padding: 1px;">
                        <div class="col-12 bg-white rounded-4 p-3">

                            <!-- Cabecera -->
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                <!-- Titulo -->
                                <div>
                                    <h2 class="fw-bold text-blue mb-0">
                                        Responsiva {{ $responsiva->responsiva_number }}
                                    </h2>
                                    <span class="text-secondary" style="font-size: 14px;">
                                        Ve los datos a detalle de una Responsiva
                                    </span>
                                </div>
                            </div>

                            <!-- Contenido -->
                            <div class="col-12 mt-3">
                                <p><strong class="text-blue">Fecha de asignacion:</strong> {{ $responsiva->assigned_date }}
                                </p>
                                <p><strong class="text-blue">Condicion de entrega:</strong> {{ $responsiva->condition }}</p>
                                <p><strong class="text-blue">Ubicacion:</strong> {{ $responsiva->location }}</p>
                                <p><strong class="text-blue">Entregó con:</strong> {{ $responsiva->delivered_by }}</p>
                                <p><strong class="text-blue">Estatus:</strong> {{ $responsiva->status }}</p>
                                @if($responsiva->user_id != null)
                                    <p><strong class="text-blue">Responsiva creada por:</strong> {{ $responsiva->user->name }} -
                                        {{ $responsiva->user->email }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dispositivo -->
                <div class="pe-3 pt-3">
                    <div class="col-12 bg-gradient-teal rounded-4 shadow" style="padding: 1px;">
                        <div class="col-12 bg-white rounded-4 p-3">

                            <!-- Cabecera -->
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                <!-- Titulo -->
                                <div>
                                    <h2 class="fw-bold text-teal mb-0">
                                        Dispositivo
                                    </h2>
                                    <span class="text-secondary" style="font-size: 14px;">
                                        Ve los datos a detalle del Dispositivo
                                    </span>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <p><strong class="text-teal">Tipo:</strong> {{ $responsiva->device->type }}</p>
                                <p><strong class="text-teal">Marca:</strong> {{ $responsiva->device->brand }}</p>
                                <p><strong class="text-teal">Modelo:</strong> {{ $responsiva->device->model }}</p>
                                <p><strong class="text-teal">No. Serie:</strong> {{ $responsiva->device->serial_number }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Derecha -->
            <div class="col-lg-6 col-12">

                <!-- Usuario -->
                <div class="ps-3 pb-3">
                    <div class="col-12 bg-gradient-orange rounded-4 shadow" style="padding: 1px;">
                        <div class="col-12 bg-white rounded-4 p-3">

                            <!-- Cabecera -->
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                <!-- Titulo -->
                                <div>
                                    <h2 class="fw-bold text-orange mb-0">
                                        Usuario
                                    </h2>
                                    <span class="text-secondary" style="font-size: 14px;">
                                        Ve los datos a detalle del Usuario
                                    </span>
                                </div>
                            </div>

                            <!-- Contenido -->
                            <div class="col-12 mt-3">
                                <p><strong class="text-orange">Nombre:</strong> {{ $responsiva->teacher->full_name }}</p>
                                <p><strong class="text-orange">Email:</strong> {{ $responsiva->teacher->email }}</p>
                                <p><strong class="text-orange">Rol:</strong> {{ $responsiva->teacher->role }}</p>
                                <p><strong class="text-orange">No. Empleado:</strong>
                                    {{ $responsiva->teacher->employee_number }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acciones -->
                <div class="ps-3 pt-3">
                    <div class="col-12 bg-secondary rounded-4 shadow" style="padding: 1px;">
                        <div class="col-12 bg-white rounded-4 p-3">

                            <!-- Cabecera -->
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                <!-- Titulo -->
                                <div>
                                    <h2 class="fw-bold text-secondary mb-0">
                                        Acciones
                                    </h2>
                                    <span class="text-secondary" style="font-size: 14px;">
                                        Realiza diferentes acciones a la Responsiva
                                    </span>
                                </div>
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

                                @if ($responsiva->status === 'Activa')
                                    <!-- Editar -->
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Moal -->
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

@endsection