@extends('admin.layouts.app')

@section('title', 'Editar Categoría #' . $categoria->id_categoria)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Categorías', 'url' => route('admin.categorias.index')],
['name' => 'Editar #' . $categoria->id_categoria]
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4>Actualizar Categoría #{{ $categoria->id_categoria }}</h4>

                    <form method="POST" action="{{ route('admin.categorias.update', $categoria->id_categoria) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombre_categoria" class="form-label">Nombre de la Categoría</label>
                            <input type="text" name="nombre_categoria" id="nombre_categoria" class="form-control"
                                value="{{ old('nombre_categoria', $categoria->nombre_categoria) }}" required>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción (opcional)</label>
                            <textarea name="descripcion" id="descripcion" class="form-control"
                                rows="4">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                        </div>

                        <!-- Botón de actualizar -->
                        <button type="submit" class="btn btn-primary w-100">Actualizar Categoría</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection