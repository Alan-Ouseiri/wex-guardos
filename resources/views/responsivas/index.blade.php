@extends('layouts.app')

@section('title', 'Responsivas')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <a href="{{ route("dashboard") }}" class="text-decoration-none">
        <h6><i class="fa-solid fa-earth-americas"></i> Regresar</h6>
    </a>
</div>

<div class="d-flex justify-content-between mb-3">
    <h3>Responsivas</h3>
    <a href="{{ route('responsivas.create') }}" class="btn btn-primary">
        Nueva Responsiva
    </a>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>Fecha</th>
            <th>Folio</th>
            <th>Docente</th>
            <th>Dispositivo</th>
            <th>Serie</th>
            <th>Estado</th>
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
            <td>
                <span class="badge bg-success">
                    {{ ucfirst($r->status) }}
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection