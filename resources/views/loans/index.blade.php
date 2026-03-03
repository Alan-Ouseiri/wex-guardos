@extends('layouts.app')

@section('title', 'Prestamos')

@section('content')

<div class='d-flex justify-content-center mt-5 pb-5'>
    <div class="col-xxl-8 col-xl-10 col-lg-11 col-12">

        <!-- Titulo -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route("dashboard") }}" class="text-decoration-none text-black">
                <i class="h5 fa-solid fa-arrow-left mb-0"></i>
            </a>
            <div class="flex-fill ms-2">
                <p class="h4 fw-bold mb-0">Prestamos</p>
                <span style="font-size: 12px;">Gestiona todos los Prstamos</span>
            </div>
        </div>

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

        <!-- Buscador y Botones -->
        <div class="col-12 row mx-auto justify-content-between align-items-center p-3 rounded-4 bg-white shadow">
            <!-- Buscador -->
            <form method="GET" action="{{ route('loans.index') }}" class="col-6 mb-0">
                <input type="text" name="search" class="form-control" placeholder="&#x1F50E;&#xFE0E; Buscar por Usuario o No.serie del Dispositivo" value="{{ request('search') }}">
            </form>

            <!-- Botones -->
            <div class="col-auto row justify-content-end">
                <a href="{{ route('loans.create') }}" class="text-decoration-none text-white col-auto">
                    <div class="col-12 rounded-3 py-2 px-4 text-center" style="background: linear-gradient(135deg,rgba(173, 0, 144, 0.8) 0%, rgb(175, 0, 191) 100%);">
                        <i class="fa-solid fa-plus"></i> Nuevo Prestamo
                    </div>
                </a>
            </div>
        </div>

        <!-- Contenido -->
        <div class="col-12 mt-4">
            <table class="col-12 w-100 p-3 rounded-2 bg-white shadow">
                <!-- Cabecera -->
                <thead>
                    <tr class="col-12 row mx-auto text-white py-3 rounded-top-2" style="background: linear-gradient(135deg,rgba(173, 0, 144, 0.5) 0%, rgb(175, 0, 191) 100%);">
                        <th class="col-3">Docente</th>
                        <th class="col-3">Dispositivo</th>
                        <th class="col-2">Fecha préstamo</th>
                        <th class="col-2">Fecha devolución</th>
                        <th class="col-1 text-center">Estado</th>
                        <th class="col-1 text-center">Acciones</th>
                    </tr>
                </thead>
                <!-- Cuerpo -->
                <tbody>
                    @foreach ($loans as $loan)
                    <tr class="col-12 row mx-auto border-bottom py-3">
                        <td class="col-3">{{ $loan->teacher->full_name }}</td>
                        <td class="col-3">{{ $loan->device->brand }} {{ $loan->device->model }}</td>
                        <td class="col-2">{{ $loan->loan_date }}</td>
                        <td class="col-2">
                            @if ($loan->return_date)
                            {{ $loan->return_date }}
                            @else
                            <span class="text-muted">Pendiente</span>
                            @endif
                        </td>
                        <td class="col-1 text-center">
                            @if ($loan->status === 'active')
                            <span class="badge" style="background-color: #FEF9C2; color: #C5852E;">
                                <i class="fa-regular fa-clock"></i> Activo
                            </span>
                            @else
                            <span class="badge text-success" style="background-color: #DBFCE7;">
                                <i class="fa-regular fa-circle-check"></i> Devuelto
                            </span>
                            @endif
                        </td>
                        <td class="col-1 text-center">
                            @if ($loan->status === 'active')
                            <button type="button" style="background: none; border: none;" data-bs-toggle="modal" data-bs-target="#returnLoanModal{{ $loan->id }}">
                                <i class="fa-solid fa-arrow-rotate-left" style="color: #B004BD;" data-bs-toggle="tooltip" data-bs-placement="top" title="Devolver dispositivo"></i>
                            </button>
                            @else

                            @endif
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="returnLoanModal{{ $loan->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Confirmar devolución</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <p>
                                        ¿Confirmas que el dispositivo
                                        <strong>
                                            {{ $loan->device->type }}
                                            {{ $loan->device->brand }}
                                            {{ $loan->device->model }}
                                        </strong>
                                        fue devuelto por
                                        <strong>{{ $loan->teacher->full_name }}</strong>?
                                    </p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal">
                                        Cancelar
                                    </button>

                                    <form method="POST"
                                        action="{{ route('loans.return', $loan) }}">
                                        @csrf
                                        @method('PATCH')

                                        <button class="btn btn-success">
                                            Sí, marcar como devuelto
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>

            <div class="col-12 mt-4 d-flex justify-content-center">
                {{ $loans->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
</div>

@endsection