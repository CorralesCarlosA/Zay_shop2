@extends('admin.layouts.app')

@section('title', 'Detalle Inventario #' . $inventario->id_inventario)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Inventario', 'url' => route('admin.inventario.index')],
['name' => 'Registro #' . $inventario->id_inventario]
])

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5>Inventario #{{ $inventario->id_inventario }}</h5>
        </div>
        <div class="card-body">

            <p><strong>Producto:</strong> {{ optional($inventario->product)->nombreProducto ?? 'No encontrado' }}</p>
            <p><strong>Stock Actual:</strong> {{ $inventario->stock_actual }}</p>
            <p><strong>Stock Mínimo:</strong> {{ $inventario->stock_minimo }}</p>
            <p><strong>Última Actualización:</strong> {{ $inventario->fecha_actualizacion }}</p>
            <p><strong>Actualizado por:</strong> {{ optional($inventario->admin)->nombres ?? 'No definido' }}</p>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.inventario.edit', $inventario->id_inventario) }}"
                    class="btn btn-warning">Editar</a>
                <form action="{{ route('admin.inventario.destroy', $inventario->id_inventario) }}" method="POST"
                    onsubmit="return confirm('¿Eliminar este registro?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection