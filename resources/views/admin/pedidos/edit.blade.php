@extends('admin.layouts.app')

@section('title', 'Editar Pedido #' . $pedido->id_pedido)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Pedidos', 'url' => route('admin.pedidos.index')],
['name' => 'Editar Pedido #' . $pedido->id_pedido]
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4>Actualizar Estado del Pedido #{{ $pedido->id_pedido }}</h4>

                    <form method="POST" action="{{ route('admin.pedidos.update', $pedido->id_pedido) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="estado_pedido" class="form-label">Estado del Pedido</label>
                                <select name="estado_pedido" id="estado_pedido" class="form-select" required>
                                    @foreach ($estados as $estado)
                                    <option value="{{ $estado }}"
                                        {{ $pedido->estado_pedido == $estado ? 'selected' : '' }}>
                                        {{ $estado }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="metodo_pago" class="form-label">Método de Pago</label>
                                <select name="metodo_pago" id="metodo_pago" class="form-select" required>
                                    <option value="Efectivo" {{ $pedido->metodo_pago == 'Efectivo' ? 'selected' : '' }}>
                                        Efectivo</option>
                                    <option value="Tarjeta" {{ $pedido->metodo_pago == 'Tarjeta' ? 'selected' : '' }}>
                                        Tarjeta</option>
                                    <option value="Transferencia"
                                        {{ $pedido->metodo_pago == 'Transferencia' ? 'selected' : '' }}>Transferencia
                                    </option>
                                    <option value="Contraentrega"
                                        {{ $pedido->metodo_pago == 'Contraentrega' ? 'selected' : '' }}>Contraentrega
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="recoleccion_en_local" id="recoleccion_en_local"
                                class="form-check-input" {{ $pedido->recoleccion_en_local ? 'checked' : '' }}>
                            <label for="recoleccion_en_local" class="form-check-label">Recolección en local</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection