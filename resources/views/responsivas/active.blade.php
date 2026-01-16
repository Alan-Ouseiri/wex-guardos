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
            <th>Estatus</th>
            <th>Acciones</th>
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
            <td>{{ $r->status }}</td>
            <td class="text-center align-items-center">

                <a href="{{ route('responsivas.pdf', $r) }}" target="_blank" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Imprimir la responsiva">
                    <i class="fa-solid fa-print"></i>
                </a>

                @if ($r->status === 'active')
                <form method="POST"
                    action="{{ route('responsivas.return', $r) }}"
                    class="d-inline">
                    @csrf
                    @method('PATCH')

                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Confirmar devolución del dispositivo?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Devolucion del dispositivo">
                        <i class="fa-solid fa-file-circle-check"></i>
                    </button>
                </form>
                @endif


            </td>
        </tr>
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