@extends('layouts.app')

@section('title', 'Alta de Usuario')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <!-- Titulo -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route("teachers.index") }}" class="text-decoration-none text-black">
                <i class="h5 fa-solid fa-arrow-left mb-0"></i>
            </a>
            <div class="flex-fill ms-2">
                <p class="h4 fw-bold mb-0">Nuevo Usuario</p>
                <span style="font-size: 12px;">Completa los datos para crear un nuevo Usuario</span>
            </div>
        </div>

        <!-- Contenido -->
        <div class="col-12 p-4 rounded-4 bg-white shadow">
            <!-- Errores -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Formulario -->
            <form action="{{ route("teachers.create") }}" method="post">
                @csrf
                <!-- Nombre -->
                <div class="mb-3">
                    <label class="form-label"><i class="fa-solid fa-user-plus" style="color: #D33900;"></i> Nombre</label>
                    <input type="text" name="name" class="form-control" placeholder="Nombre del usuario" value="{{ old('name') }}">
                </div>

                <!-- Apellido -->
                <div class="mb-3">
                    <label class="form-label"><i class="fa-solid fa-user-group" style="color: #D33900;"></i> Apellido</label>
                    <input type="text" name="surname" class="form-control" placeholder="Apellido del usuario" value="{{ old('surname') }}">
                </div>

                <!-- Número de empleado -->
                <div class="mb-3">
                    <label class="form-label"><i class="fa-solid fa-hashtag" style="color: #D33900;"></i> Número de empleado</label>
                    <input type="text" name="employee_number" class="form-control" placeholder="Ej. DOC123" value="{{ old('employee_number') }}">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label"><i class="fa-regular fa-envelope" style="color: #D33900;"></i> Email</label>
                    <input type="email" name="email" class="form-control" placeholder="correo@wexford.edu.mx" value="{{ old('email') }}">
                </div>

                <!-- Rol -->
                <div class="mb-3">
                    <label class="form-label"><i class="fa-regular fa-address-book" style="color: #D33900;"></i> Rol del empleado</label>
                    <input type="text" name="role" class="form-control" placeholder="Ej. Profesor, Profesora, Administrativo" value="{{ old('role') }}">
                </div>

                <!-- Botones -->
                <div class="row g-4">
                    <div class="col-6">
                        <a href="{{ route('teachers.index') }}" class="text-decoration-none text-black">
                            <div class="col-12 border border-2 border-secondary rounded-3 py-2 h-100 w-100 text-center">
                                Cancelar
                            </div>
                        </a>
                    </div>
                    <div class="col-6">
                        <button class="text-white w-100 border border-0 h-100 rounded-3 py-2" style="background-color: #D33900;">
                            <i class="fa-regular fa-floppy-disk"></i> Crear Usuario
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection