@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')

<div class='d-flex justify-content-center mt-5 pb-5'>
    <div class="col-xl-8 col-11">

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
            <!-- Tabla -->
            <table class="col-12 w-100 p-3 rounded-2 bg-white shadow">
                <thead>
                    <tr class="col-12 row mx-auto text-white py-3 rounded-top-2" style="background: linear-gradient(135deg,rgba(250, 96, 0, 0.8), rgba(209, 59, 0, 1));">
                        <th class="col-xl-3 col-5">Nombre</th>
                        <th class="col-xl-2 d-none d-xl-table-cell">No. Empleado</th>
                        <th class="col-xl-3 col-5">Email</th>
                        <th class="col-3 d-none d-xl-table-cell">Rol</th>
                        <th class="col-xl-1 col-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                    <tr class="col-12 row mx-auto border-bottom py-3">
                        <td class="col-xl-3 col-5">{{ $teacher->full_name }}</td>
                        <td class="col-xl-2 d-none d-xl-table-cell">{{ $teacher->employee_number }}</td>
                        <td class="col-xl-3 col-5">{{ $teacher->email ?? '—' }}</td>
                        <td class="col-3 d-none d-xl-table-cell">{{ $teacher->role }}</td>
                        <td class="col-xl-1 col-2 d-flex flex-wrap justify-content-between text-center align-items-center">
                            <a href="{{ route('teachers.edit', $teacher) }}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            @if($teacher->responsivas()->where('status', 'Activa')->exists())

                            @else
                            <button type="button" class="btn btn-link text-danger p-0" data-bs-toggle="modal" data-bs-target="#deleteTeacherModal{{ $teacher->id }}">
                                <i class="fa-regular fa-trash-can text-danger"></i>
                            </button>
                            @endif
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
            <!-- Paginacion -->
            <div class="col-12 mt-4 d-flex justify-content-center">
                {{ $teachers->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection