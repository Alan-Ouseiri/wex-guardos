@extends('layouts.app')

@section('title', 'Responsivas')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <a href="{{ route("dashboard") }}" class="text-decoration-none">
        <h6><i class="fa-solid fa-house"></i> Regresar</h6>
    </a>
</div>

<div class="d-flex justify-content-between mb-3">
    <h3>Responsivas</h3>

    <div class="col-auto">
        <a href="{{ route('responsivas.create.full') }}" class="btn btn-primary">
            Nueva Responsiva en Blanco
        </a>
        <a href="{{ route('responsivas.create') }}" class="btn btn-primary">
            Nueva Responsiva
        </a>
    </div>
</div>

<form method="GET" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Buscar por folio, usuario o numero de serie"
            value="{{ request('search') }}">
        <button class="btn btn-primary">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </div>
</form>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>Fecha</th>
            <th>Folio</th>
            <th>Usuario</th>
            <th>Dispositivo</th>
            <th>Serie</th>
            <th>Imprimir</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($responsivas as $r)
        <tr>
            <td>{{ $r->assigned_date }}</td>
            <td>{{ $r->responsiva_number }}</td>
            <td>{{ $r->teacher->full_name }}</td>
            <td>{{ $r->device->description }}</td>
            <td>{{ $r->device->serial_number }}</td>
            <td class="text-center align-items-center">
                <!-- Imprimir -->
                <a href="{{ route('responsivas.pdf', $r) }}" target="_blank" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Imprimir la responsiva">
                    <i class="fa-solid fa-print"></i>
                </a>
                <!-- Historial -->
                <a href="{{ route('responsivas.history', $r) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver historial de la responsiva">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </a>
                <!-- Devolver -->
                @if ($r->status === 'active')
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#returnModal{{ $r->id }}">
                    <i class="fa-solid fa-arrow-rotate-left" data-bs-toggle="tooltip" data-bs-placement="top" title="Devolver dispositivo"></i>
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

                <a href="{{ $gmailUrl }}" target="_blank" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Enviar correo con Gmail">
                    <i class="fa-solid fa-envelope"></i>
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
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
            .forEach(el => new bootstrap.Tooltip(el));
    });
</script>