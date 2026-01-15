@extends('layouts.app')

@section('title', 'Crear Responsiva')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route("dashboard") }}" class="text-decoration-none">
                <h6><i class="fa-solid fa-house"></i> Regresar</h6>
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Nueva Responsiva</h5>
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

                <form method="POST" action="{{ route('responsivas.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date"
                            name="date"
                            class="form-control"
                            value="{{ old('date', now()->toDateString()) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Docente</label>
                        <select name="teacher_id" class="form-select">
                            <option value="">Seleccione un docente</option>
                            @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->full_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dispositivo</label>
                        <select name="device_id" class="form-select">
                            <option value="">Seleccione un dispositivo</option>
                            @foreach ($devices as $device)
                            <option value="{{ $device->id }}">
                                {{ $device->description }} - {{ $device->serial_number }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- NUEVOS CAMPOS -->

                    <div class="mb-3">
                        <label class="form-label">Condición</label>
                        <input type="text"
                            name="condition"
                            class="form-control"
                            placeholder="Ej. Usado"
                            value="{{ old('condition') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ubicación</label>
                        <input type="text"
                            name="location"
                            class="form-control"
                            placeholder="Ej. Campus Maravillas"
                            value="{{ old('location') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Entregó con</label>
                        <input type="text"
                            name="delivered_by"
                            class="form-control"
                            placeholder="Ej. Cable y cargador"
                            value="{{ old('delivered_by') }}">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('responsivas.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                        <button class="btn btn-primary">
                            Crear Responsiva
                        </button>
                    </div>
                </form>


            </div>
        </div>

    </div>
</div>
@endsection