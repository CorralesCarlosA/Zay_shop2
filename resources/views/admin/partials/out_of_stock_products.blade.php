<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5>Productos sin Stock</h5>
        <a href="{{ route('admin.inventario.index') }}?stock=0" class="btn btn-sm btn-outline-danger">
            <i class="fas fa-arrow-right me-1"></i> Gestionar
        </a>
    </div>
    <div class="card-body p-0">
        @if($productosSinStock->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <!-- Encabezados de tabla... -->
                <tbody>
                    @foreach ($productosSinStock as $producto)
                    <tr>
                        <td>{{ $producto->idProducto }}</td>
                        <td>
                            <a href="{{ route('admin.productos.edit', $producto->idProducto) }}">
                                {{ Str::limit($producto->nombreProducto, 30) }}
                            </a>
                        </td>
                        <td>{{ optional($producto->category)->nombre_categoria ?? 'Sin categoría' }}</td>
                        <td>
                            <span class="badge bg-danger">
                                Stock: {{ optional($producto->inventario)->stock_actual ?? 0 }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-success mb-0 rounded-0">
            <i class="fas fa-check-circle me-2"></i> Todo el inventario con stock disponible
        </div>
        @endif
    </div>
</div>