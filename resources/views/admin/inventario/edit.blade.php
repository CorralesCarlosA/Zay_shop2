@extends('admin.layouts.app')

@section('title', 'Editar Inventario')
@section('breadcrumbs', [
    ['name' => 'Inicio', 'url' => route('admin.dashboard')],
    ['name' => 'Inventario', 'url' => route('admin.inventario.index')],
    ['name' => 'Editar #' . $inventario->id_inventario]
])

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5>Editar Inventario</h5>
                    <a href="{{ route('admin.inventario.index') }}" class="btn btn-sm btn-outline-secondary">Volver</a>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.inventario.update', $inventario->id_inventario) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="idProducto" class="form-label">Producto</label>
                            <select name="idProducto" id="idProducto" class="form-select" disabled>
                                <option value="{{ $inventario->product->idProducto }}" selected>
                                    {{ optional($inventario->product)->nombreProducto ?? 'Producto no encontrado' }}
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="stock_actual" class="form-label">Stock Actual</label>
                            <input type="number" name="stock_actual" id="stock_actual"
                                   class="form-control" required min="0"
                                   value="{{ old('stock_actual', $inventario->stock_actual) }}">
                        </div>

                        <div class="mb-3">
                            <label for="stock_minimo" class="form-label">Stock Mínimo</label>
                            <input type="number" name="stock_minimo" id="stock_minimo"
                                   class="form-control" required min="0"
                                   value="{{ old('stock_minimo', $inventario->stock_minimo) }}">
                        </div>

                        <div class="mb-3">
                            <label for="id_administrador" class="form-label">Administrador</label>
                            <select name="id_administrador" id="id_administrador" class="form-select" required>
                                @foreach ($admins as $admin)
                                    <option value="{{ $admin->id_administrador }}"
                                        {{ $inventario->id_administrador == $admin->id_administrador ? 'selected' : '' }}>
                                        {{ $admin->nombres }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-success">Actualizar Inventario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection