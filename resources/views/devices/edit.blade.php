@extends('layouts.app')

@section('title', 'Editar Dispositivo')

@section('content')

    <!-- Atras -->
    <div class="col-12 d-flex mt-4">
        <a href="{{ route('devices.index') }}" class="boton-desplegable">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="texto-animado">Atrás</span>
        </a>
    </div>

    <!-- Contenido -->
    <div class='d-flex justify-content-center mt-3 pb-5'>
        <div class="col-xl-5 col-lg-7 col-md-9 col-11 bg-gradient-teal rounded-4 shadow" style="padding: 1px;">
            <div class="bg-white rounded-4 p-3">

                <!-- Titulo -->
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                    <div>
                        <h2 class="fw-bold text-teal mb-0"><i class="fa-regular fa-pen-to-square"></i> Editar
                            Dispositivo</h2>
                        <span class="text-secondary" style="font-size: 14px;">Completa los datos para editar un
                            Dispositivo</span>
                    </div>
                </div>

                <!-- Mensajes -->
                <div class="pt-3">
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
                </div>

                <!-- Contenido -->
                <div class="col-12 col-12 p-4 rounded-4">

                    <!-- Fomrulario -->
                    <form method="POST" action="{{ route('devices.update', $device) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label"><i class="fa-solid fa-laptop text-teal"></i>
                                Tipo</label>
                            <input type="text" name="type" class="form-control" value="{{ $device->type }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fa-regular fa-copyright text-teal"></i>
                                Marca</label>
                            <input type="text" name="brand" class="form-control" value="{{ $device->brand }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fa-solid fa-mobile text-teal"></i>
                                Modelo</label>
                            <input type="text" name="model" class="form-control" value="{{ $device->model }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fa-solid fa-barcode text-teal"></i> Número de
                                Serie</label>
                            <input type="text" name="serial_number" class="form-control"
                                value="{{ $device->serial_number }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fa-solid fa-clipboard-check text-teal"></i>
                                Estado</label>
                            <select name="status" class="form-select">

                                <option value="Disponible" {{ old('status', $device->status) == 'Disponible' ? 'selected' : '' }}>
                                    Disponible
                                </option>

                                <option value="Asignado" {{ old('status', $device->status) == 'Asignado' ? 'selected' : '' }}>
                                    Asignado
                                </option>

                                <option value="Mantenimiento" {{ old('status', $device->status) == 'Mantenimiento' ? 'selected' : '' }}>
                                    Mantenimiento
                                </option>

                                <option value="Retirado" {{ old('status', $device->status) == 'Retirado' ? 'selected' : '' }}>
                                    Retirado
                                </option>

                            </select>
                        </div>


                        <!-- Botones -->
                        <div class="row justify-content-end g-lg-5 g-4 pt-3">
                            <div class="col-auto border border-1 border-secondary rounded-3 py-2">
                                <a href="{{ route('devices.index') }}" class="text-decoration-none text-black">
                                    Cancelar
                                </a>
                            </div>
                            <div class="col-auto">
                                <button class="text-white w-100 border border-0 h-100 rounded-3 py-2 px-2 bg-teal">
                                    <i class="fa-regular fa-floppy-disk"></i> Actualizar Dispositivo
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection