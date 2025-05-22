<!-- client/perfil/edit.blade.php -->

@extends('client.layouts.app')

@section('title', 'Editar Mi Perfil')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('client.dashboard')],
['name' => 'Mi Perfil', 'url' => route('client.perfil.index')],
['name' => 'Editar']
])

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <form method="POST" action="{{ route('client.perfil.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Nombres -->
                        <div class="mb-3">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" name="nombres" id="nombres" class="form-control"
                                value="{{ old('nombres', $cliente->nombres) }}" required autofocus>
                        </div>

                        <!-- Apellidos -->
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control"
                                value="{{ old('apellidos', $cliente->apellidos) }}" required>
                        </div>

                        <!-- Correo -->
                        <div class="mb-3">
                            <label for="correoE" class="form-label">Correo Electrónico</label>
                            <input type="email" name="correoE" id="correoE" class="form-control"
                                value="{{ old('correoE', $cliente->correoE) }}" required>
                        </div>

                        <!-- Teléfono -->
                        <div class="mb-3">
                            <label for="n_telefono" class="form-label">Teléfono</label>
                            <input type="text" name="n_telefono" id="n_telefono" class="form-control"
                                value="{{ old('n_telefono', $cliente->n_telefono) }}" required>
                        </div>

                        <!-- Dirección -->
                        <div class="mb-3">
                            <label for="Direccion_recidencia" class="form-label">Dirección de Residencia</label>
                            <input type="text" name="Direccion_recidencia" id="Direccion_recidencia"
                                class="form-control"
                                value="{{ old('Direccion_recidencia', $cliente->Direccion_recidencia) }}" required>
                        </div>

                        <!-- Ciudad -->
                        <div class="mb-3">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <select name="ciudad" id="ciudad" class="form-select" required>
                                @foreach (\App\Models\admin\City::all() as $ciudad)
                                <option value="{{ $ciudad->id_ciudad }}"
                                    {{ $cliente->ciudad == $ciudad->id_ciudad ? 'selected' : '' }}>
                                    {{ $ciudad->nombre_ciudad }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botón de actualización -->
                        <button type="submit" class="btn btn-primary w-100 mt-3">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection