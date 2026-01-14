@extends('layouts.app')

@section('title', 'Panel de Control')

@section('content')
<h3 class="mb-4">Panel de Control</h3>

<div class="row g-4">

    <!-- Crear Responsiva -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Crear Responsiva</h5>
                <p class="card-text">
                    Generar una nueva responsiva para asignar un dispositivo a un docente.
                </p>
                <a href="#" class="btn btn-primary w-100">Crear</a>
            </div>
        </div>
    </div>

    <!-- Responsivas Activas -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Responsivas Activas</h5>
                <p class="card-text">
                    Consultar y gestionar las responsivas actualmente activas.
                </p>
                <a href="#" class="btn btn-success w-100">Ver</a>
            </div>
        </div>
    </div>

    <!-- Historial -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Historial de Responsivas</h5>
                <p class="card-text">
                    Ver responsivas finalizadas o canceladas.
                </p>
                <a href="#" class="btn btn-secondary w-100">Historial</a>
            </div>
        </div>
    </div>

    <!-- Alta de Maestros -->
    <div class="col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Alta de Maestros</h5>
                <p class="card-text">
                    Registrar nuevos docentes en el sistema.
                </p>
                <a href="#" class="btn btn-warning w-100">Registrar</a>
            </div>
        </div>
    </div>

    <!-- Alta de Dispositivos -->
    <div class="col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Alta de Dispositivos</h5>
                <p class="card-text">
                    Registrar nuevos dispositivos disponibles.
                </p>
                <a href="#" class="btn btn-info w-100">Registrar</a>
            </div>
        </div>
    </div>

</div>
@endsection