@extends('layouts.app')

@section('title', 'Dispositivos')

@section('content')

<!-- Mensajes de Exito -->
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="d-flex justify-content-between mb-3">
    <a href="{{ route("dashboard") }}" class="text-decoration-none">
        <h6><i class="fa-solid fa-house"></i> Regresar</h6>
    </a>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Dispositivos</h3>
    <a href="{{ route('devices.new') }}" class="btn btn-primary">
        Nuevo Dispositivo
    </a>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>Descripción</th>
            <th>Serie</th>
            <th>Estado</th>
            <th width="120">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($devices as $device)
        <tr>
            <td>{{ $device->description }}</td>
            <td>{{ $device->serial_number }}</td>
            <td>
                <span class="badge bg-secondary">
                    {{ ucfirst($device->status) }}
                </span>
            </td>
            <td>
                <a href="{{ route('devices.edit', $device) }}"
                    class="btn btn-sm btn-warning">
                    Editar
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection