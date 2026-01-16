@extends('layouts.app')

@section('title', 'Historial de Responsiva')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <a href="{{ route("dashboard") }}" class="text-decoration-none">
        <h6><i class="fa-solid fa-house"></i> Regresar</h6>
    </a>
</div>

<h4>Historial – {{ $responsiva->responsiva_number }}</h4>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Acción</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($histories as $h)
        <tr>
            <td>{{ $h->action_date }}</td>
            <td>{{ ucfirst($h->action) }}</td>
            <td>{{ $h->description }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection