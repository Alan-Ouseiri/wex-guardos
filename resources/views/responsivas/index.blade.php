@extends('layouts.app')

@section('title', 'Todas las Responsivas')

@section('scripts')
    <script type="module" src="{{ asset('js/dataTables/responsivesTable.js') }}"></script>
@endsection

@section('content')

    <!-- Atras -->
    <div class="col-12 d-flex mt-4">
        <a href="{{ route('dashboard') }}" class="boton-desplegable">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="texto-animado">Atrás</span>
        </a>
    </div>

    <!-- Contenido -->
    <div class='d-flex justify-content-center mt-3 pb-5'>
        <div class="col-xxl-8 col-xl-10 col-lg-11 col-12 rounded-4 bg-gradient-purple" style="padding: 1px;">
            <div class="bg-white rounded-4 p-3">

                <!-- Cabecera -->
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                    <!-- Titulo -->
                    <div>
                        <h2 class="fw-bold text-purple mb-0">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                            Responsivas
                        </h2>
                        <span class="text-secondary" style="font-size: 14px;">Gestiona todas las Responsivas</span>
                    </div>

                    <!-- Botones -->
                    <div class="col-auto row justify-content-end">
                        <a href="{{ route('responsivas.create') }}" class="text-decoration-none text-white col-auto">
                            <div class="col-12 rounded-3 py-2 px-4 text-center"
                                style="background: linear-gradient(135deg,rgba(79, 57, 246, 0.8) 0%, rgba(68, 45, 216, 1) 100%);">
                                <i class="fa-solid fa-plus"></i> Nueva Responsiva
                            </div>
                        </a>


                        <a href="{{ route('responsivas.create.full') }}" class="text-decoration-none text-white col-auto">
                            <div class="col-12 rounded-3 py-2 px-4 text-center"
                                style="background: linear-gradient(135deg,rgba(0, 173, 65, 0.5) 0%, rgba(0, 191, 75, 1) 100%);">
                                <i class="fa-regular fa-file"></i> En Blanco
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
                <div class="col-12 mt-4">
                    <!-- Tabla -->
                    <table id="responsiveTable" data-url="{{ route('responsivas.all') }}" class="display">
                        <thead>
                            <tr class="bg-secondary-subtle">
                                <th>Folio</th>
                                <th>Usuario</th>
                                <th>Dispositivo</th>
                                <th>No. Serie</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection