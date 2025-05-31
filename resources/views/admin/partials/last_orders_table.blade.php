@if(isset($pedidosRecientes) && $pedidosRecientes->isNotEmpty())
<table class="table table-hover mb-0">
    <thead class="table-light">
        <tr>
            <th>ID Pedido</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($pedidosRecientes as $pedido)
<tr>
    <td>{{ $pedido->id_pedido }}</td>
    <td>
        {{ $pedido->cliente->nombres ?? 'N/A' }} 
        {{ $pedido->cliente->apellidos ?? '' }}
    </td>
    <td>${{ number_format($pedido->total_pedido, 2) }}</td>
    <!-- ... otras columnas -->
</tr>
@endforeach
    </tbody>
</table>
@else
<div class="alert alert-info mb-0">
    No hay pedidos recientes para mostrar.
</div>
@endif