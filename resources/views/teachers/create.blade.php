@extends('layouts.app')

@section('title', 'Alta de Maestro')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Alta de Maestro</h5>
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
                        <input type="text" name="name" class="form-control" placeholder="Nombre del docente" value="{{ old('name') }}">
                    </div>

                    <!-- Apellido -->
                    <div class="mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text" name="surname" class="form-control" placeholder="Apellido del docente" value="{{ old('surname') }}">
                    </div>

                    <!-- Número de empleado -->
                    <div class="mb-3">
                        <label class="form-label">Número de empleado</label>
                        <input type="text" name="employee_number" class="form-control" placeholder="Ej. DOC123" value="{{ old('employee_number') }}">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email (opcional)</label>
                        <input type="email" name="email" class="form-control" placeholder="correo@escuela.edu" value="{{ old('email') }}">
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Guardar Maestro
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection