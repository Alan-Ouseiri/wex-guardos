@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')

    <!-- Atras -->
    <div class="col-12 d-flex mt-4">
        <a href="{{ route('teachers.index') }}" class="boton-desplegable">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="texto-animado">Atrás</span>
        </a>
    </div>

    <div class='d-flex justify-content-center mt-3 pb-5'>
        <div class="col-xl-5 col-lg-7 col-md-9 col-11 bg-gradient-orange rounded-4 shadow" style="padding: 1px;">
            <div class="bg-white rounded-4 p-3">

                <!-- Titulo -->
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                    <div>
                        <h2 class="fw-bold text-orange mb-0"><i class="fa-solid fa-user-pen"></i> Editar Usuario</h2>
                        <span class="text-secondary" style="font-size: 14px;">Completa los datos para editar un
                            Usuario</span>
                    </div>
                </div>

                <!-- Mensajes -->
                <div class="pt-3">
                    <!-- Errores -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Contenido -->
                <div class="col-12 col-12 p-4 rounded-4">
                    <!-- Fomrulario -->
                    <form method="POST" action="{{ route('teachers.update', $teacher) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label"><i class="fa-solid fa-user" style="color: #D33900;"></i>
                                Nombre <span class="text-danger"> * </span> </label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $teacher->name) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fa-solid fa-user-group" style="color: #D33900;"></i>
                                Apellido <span class="text-danger"> * </span></label>
                            <input type="text" name="surname" class="form-control"
                                value="{{ old('surname', $teacher->surname) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fa-solid fa-hashtag" style="color: #D33900;"></i> Número de
                                empleado</label>
                            <input type="text" name="employee_number" class="form-control"
                                value="{{ old('employee_number', $teacher->employee_number) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fa-regular fa-envelope" style="color: #D33900;"></i>
                                Email <span class="text-danger"> * </span></label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $teacher->email) }}">
                        </div>

                        <!-- Rol -->
                        <div class="mb-3">
                            <label class="form-label"><i class="fa-regular fa-address-book" style="color: #D33900;"></i>
                                Rol del empleado <span class="text-danger"> * </span>
                            </label>
                            <input type="text" name="role" class="form-control" value="{{ old('role') . $teacher->role }}">
                        </div>

                        <!-- Botones -->
                        <div class="row justify-content-end g-lg-5 g-4 pt-3">
                            <div class="col-auto border border-1 border-secondary rounded-3 py-2">
                                <a href="{{ route('teachers.index') }}" class="text-decoration-none text-black">
                                    Cancelar
                                </a>
                            </div>
                            <div class="col-auto">
                                <button class="text-white w-100 border border-0 h-100 rounded-3 py-2 px-2"
                                    style="background-color: #D33900;">
                                    <i class="fa-regular fa-floppy-disk"></i> Actualizar Usuario
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection