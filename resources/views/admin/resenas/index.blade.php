@extends('admin.layouts.app')

@section('title', 'resenas de Productos')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'resenas']
])

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de resenas</h2>
        <a href="{{ route('admin.resenas.create') }}" class="btn btn-success">Agregar Manualmente</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filtros mejorados -->
    <form method="GET" action="{{ route('admin.resenas.index') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <input type="text" name="cliente" class="form-control" placeholder="Buscar por cliente"
                    value="{{ request('cliente') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="producto" class="form-control" placeholder="Buscar por producto"
                    value="{{ request('producto') }}">
            </div>
            <div class="col-md-2">
                <select name="calificacion" class="form-select">
                    <option value="">Todas las calificaciones</option>
                    @for ($i = 1; $i <= 5; $i++) 
                        <option value="{{ $i }}" {{ request('calificacion') == $i ? 'selected' : '' }}>
                            {{ $i }} ⭐
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <select name="estado" class="form-select">
                    <option value="">Todos los estados</option>
                    <option value="Pendiente" {{ request('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="Aprobada" {{ request('estado') == 'Aprobada' ? 'selected' : '' }}>Aprobada</option>
                    <option value="Rechazada" {{ request('estado') == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
                </select>
            </div>
            <div class="col-md-2 d-grid gap-2 d-md-flex">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="{{ route('admin.resenas.index') }}" class="btn btn-secondary">Limpiar</a>
            </div>
        </div>
    </form>

    <!-- Tabla de resenas mejorada -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Calificación</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($resenas as $resena)
                <tr>
                    <td>{{ $resena->id_resena }}</td>
                    <td>{{ optional($resena->client)->nombres ?? 'Desconocido' }}</td>
                    <td>{{ optional($resena->product)->nombreProducto ?? 'Producto no encontrado' }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            @for ($i = 1; $i <= 5; $i++) 
                                <span class="text-{{ $i <= $resena->calificacion ? 'warning' : 'muted' }}">★</span>
                            @endfor
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-{{ 
                            $resena->estado_resena == 'Aprobada' ? 'success' : 
                            ($resena->estado_resena == 'Rechazada' ? 'danger' : 'warning') 
                        }}">
                            {{ $resena->estado_resena }}
                        </span>
                    </td>
                    <td>{{ $resena->fecha_resena->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.resenas.show', $resena->id_resena) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('admin.resenas.edit', $resena->id_resena) }}" class="btn btn-sm btn-warning">Editar</a>
                            @if($resena->estado_resena == 'Pendiente')
                                <form action="{{ route('admin.comentarios.aprobar', $resena->id_resena) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Aprobar</button>
                                </form>
                                <form action="{{ route('admin.comentarios.rechazar', $resena->id_resena) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Rechazar</button>
                                </form>
                            @endif
                            <form action="{{ route('admin.resenas.destroy', $resena->id_resena) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar esta resena?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No se encontraron resenas</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $resenas->links() }}
    </div>
</div>
@endsection