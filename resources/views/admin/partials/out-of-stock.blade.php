{{-- resources/views/admin/partials/out-of-stock.blade.php --}}
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Productos Agotados</h5>
    </div>
    <div class="card-body">
        @if(isset($outOfStockProducts) && count($outOfStockProducts) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Disponibles</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($outOfStockProducts as $producto)
                            <tr>
                                <td>{{ $producto->codigoIdentificador }}</td>
                                <td>{{ $producto->nombreProducto }}</td>
                                <td class="{{ $producto->cantidadDisponible <= 0 ? 'text-danger' : 'text-warning' }}">
                                    {{ $producto->cantidadDisponible }}
                                </td>
                                <td>${{ number_format($producto->precioProducto, 2) }}</td>
                                <td>
                                    <a href="{{ route('admin.productos.edit', $producto->idProducto) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        Reabastecer
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-success mb-0">
                <i class="fas fa-check-circle"></i> Todos los productos tienen stock disponible
            </div>
        @endif
    </div>
</div>