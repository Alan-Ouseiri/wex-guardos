@extends('layouts.app')

@section('title', 'Dispositivos')

@section('content')

<div class='d-flex justify-content-center mt-5 pb-5'>
    <div class="col-xl-8 col-11">

        <!-- Titulo -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route("dashboard") }}" class="text-decoration-none text-black">
                <i class="h5 fa-solid fa-arrow-left mb-0"></i>
            </a>
            <div class="flex-fill ms-2">
                <p class="h4 fw-bold mb-0">Dispositivos</p>
                <span style="font-size: 12px;">Gestiona todos los Dispositivos</span>
            </div>
        </div>

        <!-- Mensajes de Exito -->
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Buscador y Botones -->
        <div class="col-12 row mx-auto justify-content-between align-items-center p-3 rounded-4 bg-white shadow">
            <!-- Buscador -->
            <form method="GET" class="col-6 mb-0">
                <input type="text" name="search" class="form-control" placeholder="&#x1F50E;&#xFE0E; Buscar por número de serie" value="{{ request('search') }}">
            </form>

            <!-- Botones -->
            <div class="col-auto row justify-content-end">
                <a href="{{ route('devices.new') }}" class="text-decoration-none text-white col-auto">
                    <div class="col-12 rounded-3 py-2 px-4 text-center" style="background: linear-gradient(135deg,rgba(113, 207, 198, 0.9) 0%, rgba(14, 136, 127, 1) 100%);">
                        <i class="fa-solid fa-plus"></i> Nuevo Dispositivo
                    </div>
                </a>
            </div>
        </div>

        <!-- Contenido -->
        <div class="col-12 mt-4">
            <!-- Tabla -->
            <table class="col-12 w-100 p-3 rounded-2 bg-white shadow">
                <thead>
                    <tr class="col-12 row mx-auto text-white py-3 rounded-top-2" style="background: linear-gradient(135deg,rgba(0, 180, 161, 0.8), rgba(0, 127, 117, 1));">
                        <th class="col-4">Dispositivo</th>
                        <th class="col-4">No. Serie</th>
                        <th class="col-2">Estado</th>
                        <th class="col-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devices as $device)
                    <tr class="col-12 row mx-auto border-bottom py-3">
                        <td class="col-4">{{ $device->description }}</td>
                        <td class="col-4">{{ $device->serial_number }}</td>
                        <td class="col-2">{{ ucfirst($device->status) }}</td>
                        <td class="col-2 text-center">
                            <a href="{{ route('devices.edit', $device) }}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Paginacion -->
            <div class="col-12 mt-4 d-flex justify-content-center">
                {{ $devices->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection