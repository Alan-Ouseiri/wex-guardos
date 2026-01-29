@extends('layouts.app')

@section('title', 'Historial de Responsiva')

@section('content')

<div class='d-flex justify-content-center mt-5 pb-5'>
    <div class="col-xl-8 col-11">

        <!-- Titulo -->
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route("responsivas.index") }}" class="text-decoration-none text-black">
                <i class="h5 fa-solid fa-arrow-left mb-0"></i>
            </a>
            <div class="flex-fill ms-2">
                <p class="h4 fw-bold mb-0">Historial - {{ $responsiva->responsiva_number }}</p>
                <span style="font-size: 12px;">Ve el historial de movimientos de una Responsiva</span>
            </div>
        </div>

        <!-- Contenido -->
        <div class="col-12 mt-4">
            <table class="col-12 w-100 p-3 rounded-2 bg-white shadow">
                <thead>
                    <tr class="col-12 row mx-auto text-white py-3 rounded-top-2" style="background: linear-gradient(135deg,rgba(166, 63, 255, 0.8), rgba(136, 13, 224, 1));">
                        <th class="col-3">Fecha</th>
                        <th class="col-3">Acción</th>
                        <th class="col-5">Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($histories as $h)
                    <tr class="col-12 row mx-auto border-bottom py-3">
                        <td class="col-3">{{ $h->action_date }}</td>
                        <td class="col-3">{{ ucfirst($h->action) }}</td>
                        <td class="col-5">{{ $h->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Paginacion -->
            <div class="col-12 mt-4 d-flex justify-content-center">
                {{ $histories->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection