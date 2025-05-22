@extends('client.layouts.app')

@section('title', 'Mi Perfil')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('client.dashboard')],
['name' => 'Mi Perfil']
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5>Mi Perfil</h5>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('client.perfil.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" name="nombres" id="nombres" class="form-control"
                                    value="{{ old('nombres', $cliente->nombres) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" name="apellidos" id="apellidos" class="form-control"
                                    value="{{ old('apellidos', $cliente->apellidos) }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="correoE" class="form-label">Correo Electrónico</label>
                            <input type="email" name="correoE" id="correoE" class="form-control"
                                value="{{ old('correoE', $cliente->correoE) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="n_telefono" class="form-label">Teléfono</label>
                            <input type="text" name="n_telefono" id="n_telefono" class="form-control"
                                value="{{ old('n_telefono', $cliente->n_telefono) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="Direccion_recidencia" class="form-label">Dirección de Residencia</label>
                            <input type="text" name="Direccion_recidencia" id="Direccion_recidencia"
                                class="form-control"
                                value="{{ old('Direccion_recidencia', $cliente->Direccion_recidencia) }}" required>
                        </div>

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

                        <button type="submit" class="btn btn-primary w-100 mt-3">Actualizar Datos</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection