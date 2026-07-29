@extends('layouts.app')

@section('title', 'Usuarios')

@section('scripts')
<script src="{{ asset('js/dataTables/teachersTable.js') }}"></script>
@endsection

@section('content')

<div class='d-flex justify-content-center mt-5 pb-5'>
    <div class="col-xxl-8 col-xl-10 col-lg-11 col-12">

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
        <div class="col-12 d-flex justify-content-end">
            <div class="col-auto">
                <a href="{{ route('teachers.new') }}" class="text-decoration-none text-white col-auto">
                    <div class="col-12 rounded-3 py-2 px-4 text-center" style="background: linear-gradient(135deg,rgba(244, 73, 0, 0.8) 0%, rgba(204, 54, 0, 1) 100%);">
                        <i class="fa-solid fa-plus"></i> Nuevo Usuario
                    </div>
                </a>
            </div>
        </div>

        <!-- Tabla -->
        <div class="mt-4">
            <table id="miTabla" data-url="{{ route('teachers.all') }}" data-edit-url="{{ route('teachers.edit', 0) }}" class="display bg-white" style="width:100%">
                <thead>
                    <tr class="bg-gradient-orange">
                        <th class="text-white">Nombre</th>
                        <th class="text-white">Email</th>
                        <th class="text-white">Rol</th>
                        <th class="text-white">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        @foreach ($teachers as $teacher)
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
    </div>
</div>

@endsection