@extends('layouts.app')

@section('title', 'Alta de Dispositivo')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <!-- Titulo -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route("devices.index") }}" class="text-decoration-none text-black">
                <i class="h5 fa-solid fa-arrow-left mb-0"></i>
            </a>
            <div class="flex-fill ms-2">
                <p class="h4 fw-bold mb-0">Nuevo Dispositivo</p>
                <span style="font-size: 12px;">Completa los datos para crear un nuevo Dispositivo</span>
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
            <form method="POST" action="{{ route('devices.create') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label"><i class="fa-solid fa-laptop" style="color: #0E887F;"></i> Tipo</label>
                    <input type="text" name="type" class="form-control" placeholder="Ej. Macbook, iPad, iMac" value="{{ old('type') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa-regular fa-copyright" style="color: #0E887F;"></i> Marca</label>
                    <input type="text" name="brand" class="form-control" placeholder="Ej. Apple, Lenovo, MSI" value="{{ old('brand') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa-solid fa-mobile" style="color: #0E887F;"></i> Modelo</label>
                    <input type="text" name="model" class="form-control" placeholder="Ej. 5 Gen, 8, Air 11" value="{{ old('model') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa-solid fa-barcode" style="color: #0E887F;"></i> Número de Serie</label>
                    <input type="text" name="serial_number" class="form-control" placeholder="xxxxxxxxxxxx" value="{{ old('serial_number') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa-solid fa-clipboard-check" style="color: #0E887F;"></i> Estado</label>
                    <select name="status" class="form-select">
                        <option value="available">Disponible</option>
                        <option value="assigned">Asignado</option>
                        <option value="maintenance">Mantenimiento</option>
                        <option value="retired">Retirado</option>
                    </select>
                </div>

                <!-- Botones -->
                <div class="row g-4">
                    <div class="col-6">
                        <a href="{{ route('devices.index') }}" class="text-decoration-none text-black">
                            <div class="col-12 border border-2 border-secondary rounded-3 py-2 h-100 w-100 text-center">
                                Cancelar
                            </div>
                        </a>
                    </div>
                    <div class="col-6">
                        <button class="text-white w-100 border border-0 h-100 rounded-3 py-2" style="background-color: #0E887F;">
                            <i class="fa-regular fa-floppy-disk"></i> Crear Dispositivo
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection