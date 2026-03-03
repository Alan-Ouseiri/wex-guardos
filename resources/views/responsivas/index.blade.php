@extends('layouts.app')

@section('title', 'Todas las Responsivas')

@section('content')

<div class='d-flex justify-content-center mt-5 pb-5'>
    <div class="col-xl-8 col-11">

        <!-- Titulo -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route("dashboard") }}" class="text-decoration-none text-black">
                <i class="h5 fa-solid fa-arrow-left mb-0"></i>
            </a>
            <div class="flex-fill ms-2">
                <p class="h4 fw-bold mb-0">Responsivas</p>
                <span style="font-size: 12px;">Gestiona todas las Responsivas</span>
            </div>
        </div>

        <!-- Mensajes de Exito -->
        @if (session('success'))
        <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-regular fa-circle-check"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Mensajes de Error -->
        @if(session('error'))
        <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Buscador y Botones -->
        <div class="col-12 row mx-auto justify-content-between align-items-center p-3 rounded-4 bg-white shadow">
            <!-- Buscador -->
            <form method="GET" class="col-lg-6 col-12 mb-lg-0 mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="&#x1F50E;&#xFE0E; Buscar por folio, apellido del usuario o numero de serie" value="{{ request('search') }}">
                    <a href="{{ route("responsivas.index") }}" class="btn btn-outline-danger">
                        <i class="fa-solid fa-eraser"></i>
                    </a>
                </div>
            </form>

            <!-- Botones -->
            <div class="col-auto row justify-content-end">
                <a href="{{ route('responsivas.create') }}" class="text-decoration-none text-white col-auto">
                    <div class="col-12 rounded-3 py-2 px-4 text-center" style="background: linear-gradient(135deg,rgba(79, 57, 246, 0.8) 0%, rgba(68, 45, 216, 1) 100%);">
                        <i class="fa-solid fa-plus"></i> Nueva Responsiva
                    </div>
                </a>


                <a href="{{ route('responsivas.create.full') }}" class="text-decoration-none text-white col-auto">
                    <div class="col-12 rounded-3 py-2 px-4 text-center" style="background: linear-gradient(135deg,rgba(0, 173, 65, 0.5) 0%, rgba(0, 191, 75, 1) 100%);">
                        <i class="fa-regular fa-file"></i> En Blanco
                    </div>
                </a>
            </div>
        </div>

        <!-- Contenido -->
        <div class="col-12 mt-4">
            <table class="col-12 w-100 p-3 rounded-2 bg-white shadow">
                <!-- Cabecera -->
                <thead>
                    <tr class="col-12 row mx-auto text-white py-3 rounded-top-2" style="background: linear-gradient(135deg,rgba(166, 63, 255, 0.8), rgba(136, 13, 224, 1));">
                        <th class="col-lg-2 col-3">Folio</th>
                        <th class="col-lg-3 col-4">Usuario</th>
                        <th class="col-lg-2 col-3">Dispositivo</th>
                        <th class="col-lg-2 d-none d-lg-table-cell">Serie</th>
                        <th class="col-2 d-none d-lg-table-cell">Estatus</th>
                        <th class="col-1 text-center">Acciones</th>
                    </tr>
                </thead>
                <!-- Cuerpo -->
                <tbody>
                    @foreach ($responsivas as $r)
                    <tr class="col-12 row mx-auto border-bottom py-3">
                        <td class="col-lg-2 col-3 fw-bold" style="color: #462FDD;">{{ $r->responsiva_number }}</td>
                        <td class="col-lg-3 col-4">{{ $r->teacher->full_name }}</td>
                        <td class="col-lg-2 col-3">{{ $r->device->description }}</td>
                        <td class="col-lg-2 d-none d-lg-table-cell text-truncate">{{ $r->device->serial_number }}</td>
                        <td class="col-2 d-none d-lg-table-cell">{{ $r->status }}</td>
                        <td class="col-1 d-flex flex-wrap justify-content-around text-center align-items-center">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-gear"></i>
                                </button>
                                <ul class="dropdown-menu text-center">
                                    <li class="d-flex flex-wrap p-2 justify-content-around">
                                        <!-- Imprimir -->
                                        <a href="{{ route('responsivas.pdf', $r) }}" target="_blank" class="text-decoration-none"" data-bs-toggle=" tooltip" data-bs-placement="top" title="Imprimir la responsiva">
                                            <i class="fa-solid fa-print"></i>
                                        </a>
                                        <!-- Edicion -->
                                        @if ($r->status === 'Activa')
                                        <a href="{{ route('responsivas.edit', $r) }}" class="text-warning"" data-bs-toggle=" tooltip" data-bs-placement="top" title="Editar la responsiva">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        @endif
                                        <!-- Ver -->
                                        <a href="{{ route('responsivas.show', $r) }}" class="text-success"" data-bs-toggle=" tooltip" data-bs-placement="top" title="Ver la responsiva">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                    </li>
                                    <li class="d-flex flex-wrap p-2 justify-content-around">
                                        <!-- Historial -->
                                        <a href="{{ route('responsivas.history', $r) }}" class="text-decoration-none"" data-bs-toggle=" tooltip" data-bs-placement="top" title="Ver historial de la responsiva">
                                            <i class="fa-solid fa-clock-rotate-left" style="color: #A52EFB;"></i>
                                        </a>
                                        <!-- Devolver -->
                                        @if ($r->status === 'Activa')
                                        <button style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#returnModal{{ $r->id }}">
                                            <i class="fa-solid fa-arrow-rotate-left" style="color: #F54900;" data-bs-toggle="tooltip" data-bs-placement="top" title="Devolver dispositivo"></i>
                                        </button>
                                        @endif
                                        <!-- Correo -->
                                        @if ($r->status === 'Activa' && $r->teacher->email)
                                        @php
                                        $to = rawurlencode($r->teacher->email);

                                        $subject = rawurlencode(
                                        'Responsiva de ' . $r->device->description
                                        );

                                        $body = rawurlencode(
                                        "Estimado(a) {$r->teacher->name} {$r->teacher->surname},\n\n" .
                                        "Por medio del presente se le informa la asignación del siguiente dispositivo, el cual queda bajo su resguardo:\n\n" .
                                        "Dispositivo: {$r->device->description}\n" .
                                        "Número de serie: {$r->device->serial_number}\n" .
                                        "Folio de responsiva: {$r->responsiva_number}\n" .
                                        "Código de verificación: {$r->verification_code}\n\n" .
                                        "Es indispensable que conserve este correo y, especialmente, el código de verificación, ya que le será solicitado obligatoriamente al momento de la devolución del dispositivo.\n\n" .
                                        "En caso de tener cualquier duda, aclaración o requerir apoyo adicional, puede acudir directamente al área de Cultura Digital o comunicarse al correo electrónico info.culturadigital@wexford.edu.mx.\n\n" .
                                        "Agradecemos su atención y colaboración.\n" .
                                        "Atentamente,\n" .
                                        "Cultura Digital\n".
                                        "Colegio Wexford"
                                        );

                                        $gmailUrl = "https://mail.google.com/mail/?view=cm&fs=1&to={$to}&su={$subject}&body={$body}";
                                        @endphp

                                        <a href="{{ $gmailUrl }}" target="_blank" class="text-decoration-none"" data-bs-toggle=" tooltip" data-bs-placement="top" title="Enviar correo con Gmail">
                                            <i class="fa-solid fa-envelope" style="color: #00A63E;"></i>
                                        </a>
                                        @endif
                                        <!-- Eliminar -->
                                        @if ($r->status === 'Regresado')
                                        <button style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $r->id }}">
                                            <i class="fa-regular fa-trash-can text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Responsiva"></i>
                                        </button>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal para regresar -->
                    <div class="modal fade" id="returnModal{{ $r->id }}">
                        <div class="modal-dialog">
                            <form method="POST"
                                action="{{ route('responsivas.return', $r) }}">
                                @csrf
                                @method('PUT')

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Devolver dispositivo</h5>
                                    </div>

                                    <div class="modal-body">
                                        <label>Código de verificación</label>
                                        <input type="text"
                                            name="verification_code"
                                            class="form-control"
                                            required>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary"
                                            data-bs-dismiss="modal">
                                            Cancelar
                                        </button>
                                        <button class="btn btn-success">
                                            Confirmar devolución
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal para eliminar -->
                    <div class="modal fade" id="deleteModal{{ $r->id }}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title text-danger">Eliminar Responsiva</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    ¿Seguro que deseas enviar esta responsiva a la papelera?
                                    <br>
                                    <strong>{{ $r->responsiva_number }}</strong>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                                        Cancelar
                                    </button>

                                    <form method="POST"
                                        action="{{ route('responsivas.destroy', $r) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">
                                            Sí, eliminar
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
            <!-- Paginacion -->
            <div class="col-12 mt-4 d-flex justify-content-center">
                {{ $responsivas->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection