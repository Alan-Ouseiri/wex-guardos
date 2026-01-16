@extends('layouts.app')

@section('title', 'Alta de Dispositivo')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route("devices.index") }}" class="text-decoration-none">
                <h6><i class="fa-solid fa-arrow-left-long"></i> Regresar</h6>
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Edicion de Dispositivo</h5>
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

                <form method="POST" action="{{ route('devices.update', $device) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <input type="text" name="type" class="form-control" value="{{ $device->type }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Marca</label>
                        <input type="text" name="brand" class="form-control" value="{{ $device->brand }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Modelo</label>
                        <input type="text" name="model" class="form-control" value="{{ $device->model }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Número de Serie</label>
                        <input type="text" name="serial_number" class="form-control" value="{{ $device->serial_number }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select name="status" class="form-select">

                            <option value="available"
                                {{ old('status', $device->status) == 'available' ? 'selected' : '' }}>
                                Disponible
                            </option>

                            <option value="assigned"
                                {{ old('status', $device->status) == 'assigned' ? 'selected' : '' }}>
                                Asignado
                            </option>

                            <option value="maintenance"
                                {{ old('status', $device->status) == 'maintenance' ? 'selected' : '' }}>
                                Mantenimiento
                            </option>

                            <option value="retired"
                                {{ old('status', $device->status) == 'retired' ? 'selected' : '' }}>
                                Retirado
                            </option>

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