@extends('layouts.app')

@section('title', 'Alta de Dispositivo')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route("devices.index") }}" class="text-decoration-none">
                <h6><i class="fa-solid fa-desktop"></i> Dispositivos</h6>
            </a>
        </div>
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Alta de Dispositivo</h5>
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

                <form method="POST" action="{{ route('devices.create') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <input type="text" name="type" class="form-control" value="{{ old('type') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Marca</label>
                        <input type="text" name="brand" class="form-control" value="{{ old('brand') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Modelo</label>
                        <input type="text" name="model" class="form-control" value="{{ old('model') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Número de Serie</label>
                        <input type="text" name="serial_number" class="form-control" value="{{ old('serial_number') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select name="status" class="form-select">
                            <option value="available">Disponible</option>
                            <option value="assigned">Asignado</option>
                            <option value="maintenance">Mantenimiento</option>
                            <option value="retired">Retirado</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('devices.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection