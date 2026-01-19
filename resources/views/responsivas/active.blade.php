@extends('layouts.app')

@section('title', 'Responsivas')

@section('content')

<div class="row">
    <div class="col-12">

        <!-- Titulo -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route("dashboard") }}" class="text-decoration-none text-black">
                <i class="h5 fa-solid fa-arrow-left mb-0"></i>
            </a>
            <div class="flex-fill ms-2">
                <p class="h4 fw-bold mb-0">Responsivas Activas</p>
                <span style="font-size: 12px;">Gestiona todas las Responsivas vigentes</span>
            </div>
        </div>

        <!-- Buscador y Botones -->
        <div class="col-12 row mx-auto justify-content-between align-items-center p-3 rounded-4 bg-white shadow">
            <!-- Buscador -->
            <form method="GET" class="col-6 mb-0">
                <input type="text" name="search" class="form-control" placeholder="&#x1F50E;&#xFE0E; Buscar por folio, usuario o numero de serie" value="{{ request('search') }}">
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
                <!-- Cabcera -->
                <thead>
                    <tr class="col-12 row mx-auto text-white py-3 rounded-top-2" style="background-color: #462FDD;">
                        <th class="col-2">Folio</th>
                        <th class="col-3">Usuario</th>
                        <th class="col-3">Dispositivo</th>
                        <th class="col-2">No. Serie</th>
                        <th class="col-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <!-- Cuerpo -->
                <tbody>
                    @foreach ($responsivas as $r)
                    <tr class="col-12 row mx-auto border-bottom py-3">
                        <td class="col-2 fw-bold" style="color: #462FDD;">{{ $r->responsiva_number }}</td>
                        <td class="col-3">{{ $r->teacher->full_name }}</td>
                        <td class="col-3">{{ $r->device->description }}</td>
                        <td class="col-2">{{ $r->device->serial_number }}</td>
                        <td class="col-2 d-flex flex-wrap justify-content-between text-center align-items-center">

                            <!-- Imprimir -->
                            <a href="{{ route('responsivas.pdf', $r) }}" target="_blank" class="text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Imprimir la responsiva">
                                <i class="fa-solid fa-print"></i>
                            </a>

                            <!-- Devolver dispositivo -->
                            @if ($r->status === 'active')
                            <button style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#returnModal{{ $r->id }}">
                                <i class="fa-solid fa-arrow-rotate-left" style="color: #F54900;" data-bs-toggle="tooltip" data-bs-placement="top" title="Devolver dispositivo"></i>
                            </button>
                            @endif

                            <!-- Correo -->
                            @if ($r->status === 'active' && $r->teacher->email)
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

                            <a href="{{ $gmailUrl }}" target="_blank" class="text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Enviar correo con Gmail">
                                <i class="fa-solid fa-envelope" style="color: #00A63E;"></i>
                            </a>
                            @endif
                        </td>
                    </tr>

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
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
            .forEach(el => new bootstrap.Tooltip(el));
    });
</script>