@extends('layouts.app')

@section('title', 'Responsivas Eliminadas')

@section('content')

<div class='d-flex justify-content-center mt-5 pb-5'>
    <div class="col-xl-8 col-11">

        <!-- Titulo -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route("dashboard") }}" class="text-decoration-none text-black">
                <i class="h5 fa-solid fa-arrow-left mb-0"></i>
            </a>
            <div class="flex-fill ms-2">
                <p class="h4 fw-bold mb-0">Papelera de Responsivas</p>
                <span style="font-size: 12px;">Gestiona todas las Responsivas eliminadas</span>
            </div>
        </div>

        <!-- Buscador y Botones -->
        <div class="col-12 row mx-auto justify-content-between align-items-center p-3 rounded-4 bg-white shadow">
            <!-- Buscador -->
            <form method="GET" class="col-lg-6 col-12 mb-lg-0 mb-3">
                <input type="text" name="search" class="form-control" placeholder="&#x1F50E;&#xFE0E; Buscar por folio, usuario o numero de serie" value="{{ request('search') }}">
            </form>
        </div>

        <!-- Contenido -->
        <div class="col-12 mt-4">
            <table class="col-12 w-100 p-3 rounded-2 bg-white shadow">
                <thead>
                    <tr class="col-12 row mx-auto text-white py-3 rounded-top-2" style="background: linear-gradient(135deg,rgba(209, 209, 209, 0.9), rgb(119, 119, 119));">
                        <th class="col-3">Folio</th>
                        <th class="col-3">Docente</th>
                        <th class="col-3">Dispositivo</th>
                        <th class="col-2">Eliminada</th>
                        <th class="col-1">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($responsivas as $r)
                    <tr class="col-12 row mx-auto border-bottom py-3">
                        <td class="col-3">{{ $r->responsiva_number }}</td>
                        <td class="col-3">{{ $r->teacher->full_name }}</td>
                        <td class="col-3">{{ $r->device->serial_number }}</td>
                        <td class="col-2">{{ $r->deleted_at->format('d/m/Y H:i') }}</td>
                        <td class="col-1 d-flex flex-wrap justify-content-around text-center align-items-center">
                            <!-- Eliminar -->
                            <form method="POST" action="{{ route('responsivas.forceDelete', $r->id) }}" onsubmit="return confirm('¿Eliminar definitivamente?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-danger" style="background: none; border: none;">
                                    <i class="fa-solid fa-trash-can" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Responsiva"></i>
                                </button>
                            </form>
                            <!-- Restaurar -->
                            <form action="{{ route('responsivas.restore', $r->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="text-success" style="background: none; border: none;" type="submit" onclick="return confirm('¿Deseas restaurar esta responsiva?')">
                                    <i class="fa-solid fa-rotate-left"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                {{ $responsivas->links() }}
            </div>
        </div>
    </div>
</div>

@endsection