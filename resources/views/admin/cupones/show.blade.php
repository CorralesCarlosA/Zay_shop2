@extends('admin.layouts.app')

@section('title', 'Detalles del Cupón #' . $cupon->id_cupon)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Cupones', 'url' => route('admin.cupones.index')],
['name' => 'Detalle #' . $cupon->id_cupon]
])

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5>Cupón #{{ $cupon->id_cupon }}</h5>
        </div>
        <div class="card-body">

            <p><strong>Código:</strong> {{ $cupon->codigo_cupon }}</p>
            <p><strong>Tipo de Descuento:</strong> {{ $cupon->tipo_descuento }}</p>
            <p><strong>Valor Mínimo de Compra:</strong> ${{ number_format($cupon->valor_comprado, 2) }}</p>
            <p><strong>Descuento:</strong>
                @if ($cupon->tipo_descuento === 'Porcentaje')
                {{ $cupon->valor }}%
                @else
                ${{ number_format($cupon->valor, 2) }}
                @endif
            </p>
            <p><strong>Expira:</strong> {{ $cupon->fecha_expiracion }}</p>
            <p><strong>Estado:</strong>
                <span class="badge bg-{{ $cupon->activo ? 'success' : 'danger' }}">
                    {{ $cupon->activo ? 'Activo' : 'Inactivo' }}
                </span>
            </p>
            <p><strong>Cant. mínima de productos:</strong> {{ $cupon->cantidad_prudcutos_minimos }}</p>
            <p><strong>Máx. usos por cliente:</strong> {{ $cupon->max_usos_por_cliente }}</p>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.cupones.edit', $cupon->id_cupon) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('admin.cupones.destroy', $cupon->id_cupon) }}" method="POST"
                    onsubmit="return confirm('¿Eliminar este cupón?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection