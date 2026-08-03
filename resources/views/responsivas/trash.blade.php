@extends('layouts.app')

@section('title', 'Responsivas Eliminadas')

@section('scripts')
    <script type="module" src="{{ asset('js/dataTables/trashTable.js') }}"></script>
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
        <div class="col-xl-8 col-11 bg-gradient-gray rounded-4" style="padding: 1px;">
            <div class="bg-white rounded-4 p-3">

                <!-- Cabecera -->
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                    <!-- Titulo -->
                    <div>
                        <h2 class="fw-bold text-gray mb-0">
                            <i class="fa-solid fa-trash-can"></i>
                            Papelera de Responsivas
                        </h2>
                        <span class="text-secondary" style="font-size: 14px;">Gestiona todas las Responsivas
                            eliminadas</span>
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
                    <table id="trashTable" data-url="{{ route('responsivas.all.trash') }}" class="display">
                        <thead>
                            <tr class="bg-secondary-subtle">
                                <th>Folio</th>
                                <th>Docente</th>
                                <th>Dispositivo</th>
                                <th>No. Serie</th>
                                <th>Eliminada</th>
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