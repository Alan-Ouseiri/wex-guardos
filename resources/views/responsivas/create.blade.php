@extends('layouts.app')

@section('title', 'Crear Responsiva')

@section('scripts')
    <script type="module" src="{{ asset('js/generales/buscador.js') }}"></script>
@endsection

@section('content')

    <!-- Atras -->
    <div class="col-12 d-flex mt-4">
        <a href="{{ route('dashboard') }}" class="boton-desplegable">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="texto-animado">Atrás</span>
        </a>
    </div>

    <div class='d-flex justify-content-center mt-3 pb-5'>
        <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-9 col-11 bg-blue rounded-4 shadow" style="padding: 1px;">
            <div class="bg-white rounded-4 p-3">

                <!-- Titulo -->
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                    <div>
                        <h2 class="fw-bold text-blue mb-0">
                            <i class="fa-solid fa-file-circle-plus"></i> Nueva Responsiva
                        </h2>
                        <span class="text-secondary" style="font-size: 14px;">
                            Completa los datos para generar la Responsiva
                        </span>
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
                <div class="col-12">

                    <form method="POST" action="{{ route('responsivas.store') }}">
                        @csrf

                        <div class="pb-3">
                            <label class="form-label"><i class="fa-regular fa-calendar text-blue"></i> Fecha de
                                Entrega <span class="text-danger">*</span></label>
                            <input type="date" name="date" min="2020-01-01" max="2030-12-31" class="form-control"
                                value="{{ old('date', now()->toDateString()) }}">
                        </div>

                        <div class="pb-3">
                            <label class="form-label"><i class="fa-regular fa-user text-blue"></i> Usuario</label>
                            <select name="teacher_id" class="form-select select-teacher">
                                <option value="">Seleccione un usuario <span class="text-danger">*</span></option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">
                                        {{ $teacher->full_name }} — {{ $teacher->employee_number }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pb-3">
                            <label class="form-label"><i class="fa-solid fa-mobile-screen-button text-blue"></i>
                                Dispositivo</label>
                            <select name="device_id" class="form-select select-device">
                                <option value="">Seleccione un dispositivo <span class="text-danger">*</span></option>
                                @foreach ($devices as $device)
                                    <option value="{{ $device->id }}">
                                        {{ $device->description }} — {{ $device->serial_number }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="pb-3">
                            <label class="form-label"><i class="fa-solid fa-box-open text-blue"></i> Condición <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="condition" class="form-control" placeholder="Ej. Usado"
                                value="{{ old('condition') }}">
                        </div>

                        <div class="pb-3">
                            <label class="form-label"><i class="fa-solid fa-location-dot text-blue"></i> Ubicación <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="location" class="form-control" placeholder="Ej. Campus Maravillas"
                                value="{{ old('location') }}">
                        </div>

                        <div class="pb-3">
                            <label class="form-label">
                                <i class="fa-regular fa-circle-check text-blue"></i> Entregó con <span
                                    class="text-danger">*</span>
                            </label>
                            <input type="text" name="delivered_by" class="form-control" placeholder="Ej. Cable y cargador" value="{{ old('delivered_by') }}">
                        </div>

                        <!-- Botones -->
                        <div class="row justify-content-end g-lg-5 g-4 mt-3">
                            <div class="col-auto border border-1 border-secondary rounded-3 py-2">
                                <a href="{{ route('dashboard') }}" class="text-decoration-none text-black">
                                    Cancelar
                                </a>
                            </div>
                            <div class="col-auto">
                                <button class="text-white w-100 border border-0 h-100 rounded-3 py-2 px-2 bg-blue">
                                    <i class="fa-regular fa-floppy-disk"></i> Crear Responsiva
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection