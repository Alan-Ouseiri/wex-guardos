@extends('layouts.app')

@section('title', 'Historial de Responsiva')

@section('content')
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