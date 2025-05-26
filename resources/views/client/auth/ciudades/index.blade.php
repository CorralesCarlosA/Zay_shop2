<!-- resources/views/admin/ciudades/index.blade.php -->

<table class="table table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Departamento</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cities as $city)
        <tr>
            <td>{{ $city->id_ciudad }}</td>
            <td>{{ $city->nombre_ciudad }}</td>
            <td>{{ optional($city->department)->nombre_departamento ?? 'Sin departamento' }}</td>
            <td>
                {{ $city->estado ? 'Activo' : 'Inactivo' }}
            </td>
            <td>
                <a href="{{ route('admin.ciudades.edit', $city->id_ciudad) }}"
                    class="btn btn-sm btn-outline-primary me-1">Editar</a>
                <form action="{{ route('admin.ciudades.destroy', $city->id_ciudad) }}" method="POST"
                    onsubmit="return confirm('¿Eliminar esta ciudad?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>