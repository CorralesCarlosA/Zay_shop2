@extends('admin.layouts.app')

@section('title', 'Crear Marca')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Marcas', 'url' => route('admin.marcas.index')],
['name' => 'Nuevo']
])

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.marcas.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nombre_marca" class="form-label">Nombre de la Marca</label>
                            <input type="text" name="nombre_marca" id="nombre_marca" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="3" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="estado_marca" class="form-label">Estado</label>
                            <select name="estado_marca" id="estado_marca" class="form-select" required>
                                <option value="">Selecciona un estado</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar Marca</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection