{{-- resources/views/admin/partials/recent-customers.blade.php --}}
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Clientes Recientes</h5>
    </div>
    <div class="card-body">
        @if(isset($recentCustomers) && count($recentCustomers) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Identificación</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Registro</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentCustomers as $cliente)
                            <tr>
                                <td>{{ $cliente->n_identificacion }}</td>
                                <td>{{ $cliente->nombres }} {{ $cliente->apellidos }}</td>
                                <td>{{ $cliente->n_telefono }}</td>
                                <td>{{ date('d/m/Y', strtotime($cliente->fecha_registro)) }}</td>
                                <td>
                                    <span class="badge 
                                        {{ $cliente->tipo_cliente == 'Oro' ? 'bg-warning' : '' }}
                                        {{ $cliente->tipo_cliente == 'Plata' ? 'bg-secondary' : '' }}
                                        {{ $cliente->tipo_cliente == 'Bronce' ? 'bg-danger' : '' }}
                                        {{ $cliente->tipo_cliente == 'Hierro' ? 'bg-dark' : '' }}">
                                        {{ $cliente->tipo_cliente }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
     <a href="/admin/clientes" class="btn btn-sm btn-outline-primary">
        @else
            <div class="alert alert-info mb-0">
                No hay clientes recientes
            </div>
        @endif
    </div>
</div>