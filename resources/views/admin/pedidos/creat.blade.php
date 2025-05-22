@extends('admin.layouts.app')

@section('title', 'Crear Nuevo Pedido')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Pedidos', 'url' => route('admin.pedidos.index')],
['name' => 'Nuevo Pedido']
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4>Nuevo Pedido</h4>

                    <form method="POST" action="{{ route('admin.pedidos.store') }}">
                        @csrf

                        <!-- Cliente -->
                        <div class="mb-3">
                            <label for="cliente" class="form-label">Cliente</label>
                            <select name="n_identificacion_cliente" id="cliente" class="form-select" required>
                                <option value="">Selecciona un cliente</option>
                                @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->n_identificacion }}">{{ $cliente->nombres }}
                                    ({{ $cliente->correoE }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dirección -->
                        <div class="mb-3">
                            <label for="direccion_envio" class="form-label">Dirección de envío</label>
                            <input type="text" name="direccion_envio" id="direccion_envio" class="form-control"
                                required>
                        </div>

                        <!-- Ciudad -->
                        <div class="mb-3">
                            <label for="ciudad_envio" class="form-label">Ciudad</label>
                            <select name="ciudad_envio" id="ciudad_envio" class="form-select" required>
                                <option value="">Selecciona una ciudad</option>
                                @foreach ($ciudades as $ciudad)
                                <option value="{{ $ciudad->id_ciudad }}">{{ $ciudad->nombre_ciudad }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Productos -->
                        <div class="mb-3">
                            <label class="form-label">Productos</label>
                            <div id="productos-container">
                                <div class="producto-item mb-3 p-3 border rounded bg-light">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select name="producto_id[]" class="form-select" required>
                                                <option value="">Selecciona un producto</option>
                                                @foreach ($productos as $producto)
                                                <option value="{{ $producto->idProducto }}">
                                                    {{ $producto->nombreProducto }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="producto_talla[]" class="form-select">
                                                <option value="">Talla</option>
                                                @foreach ($tallas as $talla)
                                                <option value="{{ $talla->id_talla }}">{{ $talla->nombre_talla }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="producto_color[]" class="form-select">
                                                <option value="">Color</option>
                                                @foreach ($colores as $color)
                                                <option value="{{ $color->idColor }}">{{ $color->nombreColor }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="producto_precio[]" step="0.01"
                                                class="form-control precio-input" required>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="producto_cantidad[]"
                                                class="form-control cantidad-input" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-success mt-2" onclick="agregarProducto()">+
                                Agregar otro producto</button>
                        </div>

                        <!-- Total -->
                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="number" name="total" id="total" class="form-control" step="0.01" readonly>
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" class="btn btn-success w-100">Registrar Pedido</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function agregarProducto() {
    const container = document.getElementById('productos-container');
    const div = document.createElement('div');
    div.className = 'producto-item mb-3 p-3 border rounded bg-light';
    div.innerHTML = `
        <div class="row">
            <div class="col-md-4">
                <select name="producto_id[]" class="form-select" required>
                    <option value="">Selecciona un producto</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->idProducto }}">{{ $producto->nombreProducto }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="producto_talla[]" class="form-select">
                    <option value="">Talla</option>
                    @foreach ($tallas as $talla)
                        <option value="{{ $talla->id_talla }}">{{ $talla->nombre_talla }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="producto_color[]" class="form-select">
                    <option value="">Color</option>
                    @foreach ($colores as $color)
                        <option value="{{ $color->idColor }}">{{ $color->nombreColor }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="producto_precio[]" step="0.01" class="form-control precio-input" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="producto_cantidad[]" class="form-control cantidad-input" required>
            </div>
        </div>
    `;
    container.appendChild(div);

    // Recalcular total
    div.querySelector('.precio-input').addEventListener('change', calcularTotal);
    div.querySelector('.cantidad-input').addEventListener('change', calcularTotal);
}

function calcularTotal() {
    let total = 0;
    const precios = document.querySelectorAll('[name^="producto_precio"]');
    const cantidades = document.querySelectorAll('[name^="producto_cantidad"]');

    precios.forEach((precioInput, index) => {
        const precio = parseFloat(precioInput.value || 0);
        const cantidad = parseFloat(cantidades[index].value || 0);
        total += precio * cantidad;
    });

    document.getElementById('total').value = total.toFixed(2);
}
</script>
@endsection