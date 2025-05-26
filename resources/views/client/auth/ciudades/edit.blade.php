<!-- resources/views/admin/ciudades/edit.blade.php -->

@extends('layouts.admin')

@section('title', 'Editar Ciudad #' . $city->id_ciudad)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Ciudades', 'url' => route('admin.ciudades.index')],
['name' => 'Editar #' . $city->id_ciudad]
])

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.ciudades.update', $city->id_ciudad) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nombre_ciudad" class="form-label">Nombre de la Ciudad</label>
                            <input type="text" name="nombre_ciudad" id="nombre_ciudad" class="form-control"
                                value="{{ old('nombre_ciudad', $city->nombre_ciudad) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="id_departamento" class="form-label">Departamento</label>
                            <select name="id_departamento" id="id_departamento" class="form-select" required>
                                <option value="">Selecciona un departamento</option>
                                @foreach ($departments as $department)
                                <option value="{{ $department->id_departamento }}"
                                    {{ old('id_departamento', $city->id_departamento) == $department->id_departamento ? 'selected' : '' }}>
                                    {{ $department->nombre_departamento }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Estado -->
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estado" id="estado" class="form-select" required>
                                <option value="">Selecciona estado</option>
                                <option value="1" {{ old('estado', $city->estado) == 1 ? 'selected' : '' }}>Activo
                                </option>
                                <option value="0" {{ old('estado', $city->estado) == 0 ? 'selected' : '' }}>Inactivo
                                </option>
                            </select>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Actualizar Ciudad</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection