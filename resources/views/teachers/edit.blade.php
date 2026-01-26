@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <!-- Titulo -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route("teachers.index") }}" class="text-decoration-none text-black">
                <i class="h5 fa-solid fa-arrow-left mb-0"></i>
            </a>
            <div class="flex-fill ms-2">
                <p class="h4 fw-bold mb-0">Editar Usuario</p>
                <span style="font-size: 12px;">Completa los datos para editar un Usuario</span>
            </div>
        </div>

        <!-- Contenido -->
        <div class="col-12 col-12 p-4 rounded-4 bg-white shadow">
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

            <!-- Fomrulario -->
            <form method="POST" action="{{ route('teachers.update', $teacher) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label"><i class="fa-solid fa-user-plus" style="color: #D33900;"></i> Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $teacher->name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa-solid fa-user-group" style="color: #D33900;"></i> Apellido</label>
                    <input type="text" name="surname" class="form-control" value="{{ old('surname', $teacher->surname) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa-solid fa-hashtag" style="color: #D33900;"></i> Número de empleado</label>
                    <input type="text" name="employee_number" class="form-control" value="{{ old('employee_number', $teacher->employee_number) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa-regular fa-envelope" style="color: #D33900;"></i> Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $teacher->email) }}">
                </div>

                <!-- Rol -->
                <div class="mb-3">
                    <label class="form-label"><i class="fa-regular fa-address-book" style="color: #D33900;"></i> Rol del empleado</label>
                    <input type="text" name="role" class="form-control" value="{{ old('role'). $teacher->role }}">
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
                            <i class="fa-regular fa-floppy-disk"></i> Actualizar Usuario
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </div>
</div>
@endsection