@extends('layouts.app')

@section('title', 'Historial de Responsiva')

@section('content')

    <!-- Atras -->
    <div class="col-12 d-flex mt-4">
        <a href="{{ route('responsivas.index') }}" class="boton-desplegable">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="texto-animado">Atrás</span>
        </a>
    </div>

    <div class='d-flex justify-content-center mt-5 pb-5'>
        <div class="col-xxl-8 col-xl-10 col-lg-11 col-12 bg-gradient-purple rounded-4" style="padding: 1px;">
            <div class="bg-white rounded-4 p-3">

                <!-- Titulo -->
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                    <div>
                        <h2 class="fw-bold text-purple mb-0">
                            <i class="fa-solid fa-clock-rotate-left"></i> Historial - {{ $responsiva->responsiva_number }}
                        </h2>
                        <span class="text-secondary" style="font-size: 14px;">
                            Ve el historial de movimientos de una Responsiva
                        </span>
                    </div>
                </div>

                <!-- Contenido -->
                <div class="col-12 mt-4">
                    <table class="col-12">
                        <thead>
                            <tr class="col-12 row mx-auto bg-secondary-subtle py-3">
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
                </div>
            </div>
        </div>
    </div>
@endsection