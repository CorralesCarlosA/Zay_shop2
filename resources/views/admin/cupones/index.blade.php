@extends('admin.layouts.app')

@section('title', 'Cupones - Panel Admin')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Cupones']
])

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Cupones</h2>
        <a href="{{ route('admin.cupones.create') }}" class="btn btn-success">Nuevo Cupón</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filtros -->
    <form method="GET" action="{{ route('admin.cupones.index') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-6">
                <input type="text" name="codigo_cupon" class="form-control" placeholder="Buscar por código"
                    value="{{ request('codigo_cupon') }}">
            </div>
            <div class="col-md-3">
                <select name="activo" class="form-select">
                    <option value="">Todos los estados</option>
                    <option value="1" {{ request('activo') == '1' ? 'selected' : '' }}>Activos</option>
                    <option value="0" {{ request('activo') == '0' ? 'selected' : '' }}>Inactivos</option>
                </select>
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de cupones -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Tipo</th>
                <th>Min Compra</th>
                <th>Valor</th>
                <th>Vence</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cupones as $cupon)
            <tr>
                <td>{{ $cupon->id_cupon }}</td>
                <td><strong>{{ $cupon->codigo_cupon }}</strong></td>
                <td>{{ $cupon->tipo_descuento }}</td>
                <td>$ {{ number_format($cupon->valor_comprado, 2) }}</td>
                <td>
                    @if ($cupon->tipo_descuento === 'Porcentaje')
                    {{ $cupon->valor }}%
                    @else
                    ${{ number_format($cupon->valor, 2) }}
                    @endif
                </td>
                <td>{{ $cupon->fecha_expiracion }}</td>
                <td>
                    <span class="badge bg-{{ $cupon->activo ? 'success' : 'danger' }}">
                        {{ $cupon->activo ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.cupones.show', $cupon->id_cupon) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('admin.cupones.edit', $cupon->id_cupon) }}"
                        class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.cupones.destroy', $cupon->id_cupon) }}" method="POST"
                        style="display:inline;" onsubmit="return confirm('¿Eliminar este cupón?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection