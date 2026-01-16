@extends('layouts.app')

@section('title', 'Maestros')

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
    <h3>Usuarios</h3>
    <a href="{{ route('teachers.new') }}" class="btn btn-primary">
        Nuevo Usuario
    </a>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>Nombre</th>
            <th>No. Empleado</th>
            <th>Email</th>
            <th>Rol</th>
            <th width="120">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($teachers as $teacher)
        <tr>
            <td>{{ $teacher->full_name }}</td>
            <td>{{ $teacher->employee_number }}</td>
            <td>{{ $teacher->email ?? '—' }}</td>
            <td>{{ $teacher->role }}</td>
            <td>
                <a href="{{ route('teachers.edit', $teacher) }}"
                    class="btn btn-sm btn-warning">
                    Editar
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection