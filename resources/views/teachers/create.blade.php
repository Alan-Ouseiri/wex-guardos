@extends('layouts.app')

@section('title', 'Alta de Maestro')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route("teachers.index") }}" class="text-decoration-none">
                <i class="fa-solid fa-arrow-left-long"></i> Usuarios</h6>
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Alta de Usuario</h5>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card-body">
                <form action="{{ route("teachers.create") }}" method="post">
                    @csrf
                    <!-- Nombre -->
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" placeholder="Nombre del usuario" value="{{ old('name') }}">
                    </div>

                    <!-- Apellido -->
                    <div class="mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text" name="surname" class="form-control" placeholder="Apellido del usuario" value="{{ old('surname') }}">
                    </div>

                    <!-- Número de empleado -->
                    <div class="mb-3">
                        <label class="form-label">Número de empleado</label>
                        <input type="text" name="employee_number" class="form-control" placeholder="Ej. DOC123" value="{{ old('employee_number') }}">
                    </div>

                    <!-- Rol -->
                    <div class="mb-3">
                        <label class="form-label">Rol del empleado</label>
                        <input type="text" name="role" class="form-control" placeholder="Ej. Profesor, Profesora, Administrativo" value="{{ old('role') }}">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email (opcional)</label>
                        <input type="email" name="email" class="form-control" placeholder="correo@wexford.edu.mx" value="{{ old('email') }}">
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection