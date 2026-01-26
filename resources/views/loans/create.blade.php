@extends('layouts.app')

@section('title', 'Creacion de Prestamo')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <!-- Titulo -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route("loans.index") }}" class="text-decoration-none text-black">
                <i class="h5 fa-solid fa-arrow-left mb-0"></i>
            </a>
            <div class="flex-fill ms-2">
                <p class="h4 fw-bold mb-0">Nuevo Prestamo</p>
                <span style="font-size: 12px;">Completa los datos para crear un nuevo Prestamo</span>
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
            <form method="POST" action="{{ route('loans.store') }}">
                @csrf

                {{-- Fecha préstamo --}}
                <div class="mb-3">
                    <label class="form-label"><i class="fa-regular fa-calendar" style="color: #B108BB;"></i> Fecha de préstamo</label>
                    <input type="date" name="loan_date" class="form-control" value="{{ now()->toDateString() }}" required>
                </div>

                {{-- Usuario --}}
                <div class="mb-3">
                    <label class="form-label"><i class="fa-regular fa-user" style="color: #B108BB;"></i> Usuario</label>
                    <select name="teacher_id" class="form-select select-teacher" required>
                        <option value="">Seleccione un Usuario</option>
                        @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">
                            {{ $teacher->full_name }} - {{ $teacher->employee_number }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Dispositivo --}}
                <div class="mb-3">
                    <label class="form-label"><i class="fa-solid fa-mobile-screen-button" style="color: #B108BB;"></i> Dispositivo</label>
                    <select name="device_id" class="form-select select-device" required>
                        <option value="">Seleccione un dispositivo</option>
                        @foreach ($devices as $device)
                        <option value="{{ $device->id }}">
                            {{ $device->description }} - {{ $device->serial_number }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Ubicación --}}
                <div class="mb-3">
                    <label class="form-label"><i class="fa-solid fa-location-dot" style="color: #B108BB;"></i> Seccion</label>
                    <input type="text" name="location" class="form-control" required>
                </div>

                {{-- Notas --}}
                <div class="mb-3">
                    <label class="form-label"><i class="fa-regular fa-comment" style="color: #B108BB;"></i> Notas</label>
                    <textarea name="notes" rows="3" class="form-control"></textarea>
                </div>

                <!-- Botones -->
                <div class="row g-4">
                    <div class="col-6">
                        <a href="{{ route('loans.index') }}" class="text-decoration-none text-black">
                            <div class="col-12 border border-2 border-secondary rounded-3 py-2 h-100 w-100 text-center">
                                Cancelar
                            </div>
                        </a>
                    </div>
                    <div class="col-6">
                        <button class="text-white w-100 border border-0 h-100 rounded-3 py-2" style="background-color: #B108BB;">
                            <i class="fa-regular fa-floppy-disk"></i> Crear Prestamo
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection