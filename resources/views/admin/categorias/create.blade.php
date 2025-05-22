@extends('admin.layouts.app')

@section('title', 'Crear Nueva Categoría')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Categorías', 'url' => route('admin.categorias.index')],
['name' => 'Nuevo']
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4>Nueva Categoría</h4>

                    <form method="POST" action="{{ route('admin.categorias.store') }}">
                        @csrf

                        <!-- Nombre de la categoría -->
                        <div class="mb-3">
                            <label for="nombre_categoria" class="form-label">Nombre de la Categoría</label>
                            <input type="text" name="nombre_categoria" id="nombre_categoria" class="form-control"
                                required autofocus>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción (opcional)</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="4"></textarea>
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" class="btn btn-success w-100">Guardar Categoría</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection