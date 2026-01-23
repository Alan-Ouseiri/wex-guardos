@extends('layouts.app')

@section('title', 'Maestros')

@section('content')
<div class="row">
    <div class="col-12">

        <!-- Titulo -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route("dashboard") }}" class="text-decoration-none text-black">
                <i class="h5 fa-solid fa-arrow-left mb-0"></i>
            </a>
            <div class="flex-fill ms-2">
                <p class="h4 fw-bold mb-0">Usuarios</p>
                <span style="font-size: 12px;">Gestiona todos los Usuarios</span>
            </div>
        </div>

        <!-- Mensajes de Exito -->
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Buscador y Botones -->
        <div class="col-12 row mx-auto justify-content-between align-items-center p-3 rounded-4 bg-white shadow">
            <!-- Buscador -->
            <form method="GET" class="col-6 mb-0">
                <input type="text" name="search" class="form-control" placeholder="&#x1F50E;&#xFE0E; Buscar por nombre, email o No. empleado" value="{{ request('search') }}">
            </form>

            <!-- Botones -->
            <div class="col-auto row justify-content-end">
                <a href="{{ route('teachers.new') }}" class="text-decoration-none text-white col-auto">
                    <div class="col-12 rounded-3 py-2 px-4 text-center" style="background: linear-gradient(135deg,rgba(244, 73, 0, 0.8) 0%, rgba(204, 54, 0, 1) 100%);">
                        <i class="fa-solid fa-plus"></i> Nuevo Usuario
                    </div>
                </a>
            </div>
        </div>

        <!-- Contenido -->
        <div class="col-12 mt-4">
            <table class="col-12 w-100 p-3 rounded-2 bg-white shadow">
                <thead>
                    <tr class="col-12 row mx-auto text-white py-3 rounded-top-2" style="background-color: #D33900;">
                        <th class="col-3">Nombre</th>
                        <th class="col-2">No. Empleado</th>
                        <th class="col-3">Email</th>
                        <th class="col-3">Rol</th>
                        <th class="col-1">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                    <tr class="col-12 row mx-auto border-bottom py-3">
                        <td class="col-3">{{ $teacher->full_name }}</td>
                        <td class="col-2">{{ $teacher->employee_number }}</td>
                        <td class="col-3">{{ $teacher->email ?? '—' }}</td>
                        <td class="col-3">{{ $teacher->role }}</td>
                        <td class="col-1 d-flex flex-wrap justify-content-around text-center align-items-center">
                            <a href="{{ route('teachers.edit', $teacher) }}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <button type="button" class="btn btn-link text-danger p-0" data-bs-toggle="modal" data-bs-target="#deleteTeacherModal{{ $teacher->id }}">
                                <i class="fa-regular fa-trash-can text-danger"></i>
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="deleteTeacherModal{{ $teacher->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title text-danger">
                                        Confirmar eliminación
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <p>
                                        ¿Estás seguro de que deseas eliminar al docente
                                        <strong>{{ $teacher->full_name }}</strong>?
                                    </p>
                                    <p class="text-muted mb-0">
                                        Esta acción no se puede deshacer.
                                    </p>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                                        Cancelar
                                    </button>

                                    <form method="POST" action="{{ route('teachers.destroy', $teacher) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
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
            <div class="col-12 mt-4 d-flex justify-content-center">
                {{ $teachers->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection