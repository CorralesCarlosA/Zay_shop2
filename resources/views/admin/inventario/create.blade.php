@extends('admin.layouts.app')

@section('title', 'Nuevo Registro de Inventario')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Inventario', 'url' => route('admin.inventario.index')],
['name' => 'Nuevo']
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4>Nuevo Registro de Inventario</h4>

                    <form method="POST" action="{{ route('admin.inventario.store') }}">
                        @csrf

                        <!-- Producto -->
                        <div class="mb-3">
                            <label for="idProducto" class="form-label">Producto</label>
                            <select name="idProducto" id="idProducto" class="form-select" required>
                                <option value="">Selecciona un producto</option>
                                @foreach ($productos as $producto)
                                <option value="{{ $producto->idProducto }}">{{ $producto->nombreProducto }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Stock actual -->
                        <div class="mb-3">
                            <label for="stock_actual" class="form-label">Stock Actual</label>
                            <input type="number" name="stock_actual" id="stock_actual" class="form-control" min="0"
                                required>
                        </div>

                        <!-- Stock mínimo -->
                        <div class="mb-3">
                            <label for="stock_minimo" class="form-label">Stock Mínimo</label>
                            <input type="number" name="stock_minimo" id="stock_minimo" class="form-control" min="0"
                                required>
                        </div>

                        <!-- Administrador -->
                        <div class="mb-3">
                            <label for="id_administrador" class="form-label">Administrador</label>
                            <select name="id_administrador" id="id_administrador" class="form-select" required>
                                <option value="">Selecciona un administrador</option>
                                @foreach ($admins as $admin)
                                <option value="{{ $admin->id_administrador }}">{{ $admin->nombres }}
                                    {{ $admin->apellidos }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" class="btn btn-success w-100">Guardar Inventario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection