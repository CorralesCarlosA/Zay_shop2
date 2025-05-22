@extends('admin.layouts.app')

@section('title', 'Editar Inventario #' . $inventario->id_inventario)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Inventario', 'url' => route('admin.inventario.index')],
['name' => 'Editar #' . $inventario->id_inventario]
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4>Actualizar Inventario #{{ $inventario->id_inventario }}</h4>

                    <form method="POST" action="{{ route('admin.inventario.update', $inventario->id_inventario) }}">
                        @csrf
                        @method('PUT')

                        <!-- Producto -->
                        <div class="mb-3">
                            <label for="idProducto" class="form-label">Producto</label>
                            <select name="idProducto" id="idProducto" class="form-select" disabled>
                                <option value="{{ $inventario->product->idProducto }}" selected>
                                    {{ $inventario->product->nombreProducto }}
                                </option>
                            </select>
                        </div>

                        <!-- Stock actual -->
                        <div class="mb-3">
                            <label for="stock_actual" class="form-label">Stock Actual</label>
                            <input type="number" name="stock_actual" id="stock_actual" class="form-control"
                                value="{{ old('stock_actual', $inventario->stock_actual) }}" required>
                        </div>

                        <!-- Stock mínimo -->
                        <div class="mb-3">
                            <label for="stock_minimo" class="form-label">Stock Mínimo</label>
                            <input type="number" name="stock_minimo" id="stock_minimo" class="form-control"
                                value="{{ old('stock_minimo', $inventario->stock_minimo) }}" required>
                        </div>

                        <!-- Administrador -->
                        <div class="mb-3">
                            <label for="id_administrador" class="form-label">Administrador</label>
                            <select name="id_administrador" id="id_administrador" class="form-select" required>
                                @foreach ($admins as $admin)
                                <option value="{{ $admin->id_administrador }}"
                                    {{ $inventario->id_administrador == $admin->id_administrador ? 'selected' : '' }}>
                                    {{ $admin->nombres }} {{ $admin->apellidos }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botón de actualizar -->
                        <button type="submit" class="btn btn-primary w-100">Actualizar Inventario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection