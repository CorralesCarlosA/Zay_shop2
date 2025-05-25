@extends('admin.layouts.app')

@section('title', 'Editar Marca #' . $marca->id_marca)
@section('breadcrumbs', [
['name' => 'Marcas', 'url' => route('admin.marcas.index')],
['name' => 'Editar #' . $marca->id_marca]
])

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.marcas.update', $marca->id_marca) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nombre_marca" class="form-label">Nombre de la Marca</label>
                            <input type="text" name="nombre_marca" id="nombre_marca" class="form-control"
                                value="{{ old('nombre_marca', $marca->nombre_marca) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="3"
                                class="form-control">{{ old('descripcion', $marca->descripcion) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="estado_marca" class="form-label">Estado</label>
                            <select name="estado_marca" id="estado_marca" class="form-select" required>
                                <option value="1" {{ $marca->estado_marca == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ $marca->estado_marca == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Actualizar Marca</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsectionv