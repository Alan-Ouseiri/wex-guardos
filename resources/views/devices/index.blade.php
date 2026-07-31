@extends('layouts.app')

@section('title', 'Dispositivos')

@section('scripts')
    <script type="module" src="{{ asset('js/dataTables/devicesTable.js') }}"></script>
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
        <div class="col-xxl-8 col-xl-10 col-lg-11 col-12 bg-gradient-teal rounded-4 shadow" style="padding: 1px;">
            <div class="bg-white rounded-4 p-3">

                <!-- Cabecera -->
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                    <!-- Titulo -->
                    <div>
                        <h2 class="fw-bold text-teal mb-0"><i class="fa-solid fa-mobile-screen-button"></i> Dispositivos
                        </h2>
                        <span class="text-secondary" style="font-size: 14px;">Gestiona todos los Dispositivos</span>
                    </div>

                    <!-- Boton -->
                    <div class="col-auto">
                        <a href="{{ route('devices.new') }}" class="text-decoration-none text-white">
                            <div class="rounded-3 py-2 px-4 text-center bg-gradient-teal">
                                <i class="fa-solid fa-plus"></i> Nuevo Dispositivo
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Mensajes -->
                <div class="pt-3">
                    <!-- Mensajes de Exito -->
                    @if (session('success'))
                        <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-regular fa-circle-check"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Mensajes de Error -->
                    @if(session('error'))
                        <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                </div>

                <!-- Contenido -->
                <div class="mt-4">
                    <!-- Tabla -->
                    <table id="devicesTable" data-url="{{ route('devices.all') }}" class="display">
                        <thead>
                            <tr class="bg-secondary-subtle">
                                <th>Dispositivo</th>
                                <th>No. Serie</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <!-- Modal -->
                @foreach ($devices as $device)
                    <div class="modal fade" id="deleteDeviceModal{{ $device->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title text-danger">
                                        Confirmar eliminación
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <p>
                                        ¿Estás seguro de que deseas eliminar el dispositivo
                                        <strong>{{ $device->description }}</strong>?
                                    </p>
                                    <p class="text-muted mb-0">
                                        Esta acción no se puede deshacer.
                                    </p>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                                        Cancelar
                                    </button>

                                    <form method="POST" action="{{ route('devices.destroy', $device) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            Sí, eliminar
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection