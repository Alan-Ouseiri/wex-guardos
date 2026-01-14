@extends('layouts.app')

@section('title', 'Editar Maestro')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route("teachers.index") }}" class="text-decoration-none">
                <i class="fa-solid fa-user-graduate"></i> Maestros</h6>
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Editar Maestro</h5>
            </div>

            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('teachers.update', $teacher) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $teacher->name) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text"
                            name="surname"
                            class="form-control"
                            value="{{ old('surname', $teacher->surname) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Número de empleado</label>
                        <input type="text"
                            name="employee_number"
                            class="form-control"
                            value="{{ old('employee_number', $teacher->employee_number) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email (opcional)</label>
                        <input type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $teacher->email) }}">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                        <button class="btn btn-primary">
                            Actualizar
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection