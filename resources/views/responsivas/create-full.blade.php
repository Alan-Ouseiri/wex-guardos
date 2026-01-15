@extends('layouts.app')

@section('title', 'Crear Responsiva')

@section('content')
<form method="POST" action="{{ route('responsivas.store.full') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route("dashboard") }}" class="text-decoration-none">
                <h6><i class="fa-solid fa-house"></i> Regresar</h6>
            </a>
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

        {{-- DOCENTE --}}
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">Datos del Docente</div>
                <div class="card-body">

                    <input name="teacher[name]" class="form-control mb-2" placeholder="Nombre">
                    <input name="teacher[surname]" class="form-control mb-2" placeholder="Apellido">
                    <input name="teacher[role]" class="form-control mb-2" placeholder="Rol">
                    <input name="teacher[employee_number]" class="form-control mb-2" placeholder="No. Empleado (opcional)">
                    <input name="teacher[email]" class="form-control mb-2" placeholder="Email (opcional)">

                </div>
            </div>
        </div>

        {{-- DISPOSITIVO --}}
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">Datos del Dispositivo</div>
                <div class="card-body">

                    <input name="device[type]" class="form-control mb-2" placeholder="Tipo">
                    <input name="device[brand]" class="form-control mb-2" placeholder="Marca">
                    <input name="device[model]" class="form-control mb-2" placeholder="Modelo">
                    <input name="device[serial_number]" class="form-control mb-2" placeholder="No. Serie">

                </div>
            </div>
        </div>

        {{-- RESPONSIVA --}}
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">Datos de la Responsiva</div>
                <div class="card-body">

                    <input type="date" name="assigned_date"
                        class="form-control mb-2"
                        value="{{ now()->toDateString() }}">

                    <input name="condition" class="form-control mb-2" placeholder="Condición del equipo">
                    <input name="location" class="form-control mb-2" placeholder="Ubicación">
                    <input name="delivered_by" class="form-control mb-2" placeholder="Entregado con">

                </div>
            </div>
        </div>

    </div>

    <button class="btn btn-primary">Crear Responsiva</button>
</form>
@endsection