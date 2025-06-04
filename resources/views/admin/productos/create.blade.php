@extends('admin.layouts.app')

@section('title', 'Crear Producto')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.productos.index') }}">Inicio</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Productos</li>
@endsection




@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5>Crear Nuevo Producto</h5>
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-sm btn-outline-secondary">Cancelar</a>
                </div>
                <div class="card-body p-4">

                    <form method="POST" action="{{ route('admin.productos.store') }}">
                        @csrf
<!-- Campo de imágenes -->
<div class="mb-3">
    <label for="imagenes" class="form-label">Imágenes del Producto</label>
    <input type="file" name="imagenes[]" id="imagenes" class="form-control" multiple accept="image/*">
    <small class="form-text text-muted">Puedes subir varias imágenes</small>
</div>
                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombreProducto" class="form-label">Nombre del Producto</label>
                            <input type="text" name="nombreProducto" id="nombreProducto"
                                   class="form-control @error('nombreProducto') is-invalid @enderror"
                                   value="{{ old('nombreProducto') }}" required>
                            @error('nombreProducto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcionProducto" class="form-label">Descripción del Producto</label>
                            <textarea name="descripcionProducto" id="descripcionProducto" rows="4" class="form-control">{{ old('descripcionProducto') }}</textarea>
                        </div>

                        <!-- Precio -->
                        <div class="mb-3">
                            <label for="precioProducto" class="form-label">Precio del Producto</label>
                            <input type="number" name="precioProducto" id="precioProducto"
                                   class="form-control @error('precioProducto') is-invalid @enderror"
                                   step="0.01" min="0.01" value="{{ old('precioProducto') }}" required>
                            @error('precioProducto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

  <!-- Talla -->
<div class="mb-3">
    <label for="tallaProducto" class="form-label">Talla del Producto (opcional)</label>
    <input type="text" name="tallaProducto" id="tallaProducto" class="form-control"
           value="{{ old('tallaProducto') }}">
</div>
                        <!-- Categoría -->
                        <div class="mb-3">
                            <label for="id_categoria" class="form-label">Categoría</label>
                            <select name="id_categoria" id="id_categoria" class="form-select" required>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id_categoria }}"
                                        {{ old('id_categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                                        {{ $categoria->nombre_categoria }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

<!-- Color -->
<div class="mb-3">
    <label for="idColor" class="form-label">Color del Producto</label>
    <select name="idColor" id="idColor" class="form-select" required>
        @foreach ($colores as $color)
            <option value="{{ $color->idColor }}" {{ old('idColor') == $color->idColor ? 'selected' : '' }}>
                {{ $color->nombreColor }}
            </option>
        @endforeach
    </select>
</div>

                        <!-- Clase de producto -->
                        <div class="mb-3">
                            <label for="idClaseProducto" class="form-label">Clase de Producto</label>
                            <select name="idClaseProducto" id="idClaseProducto" class="form-select" required>
                                @foreach ($clases as $clase)
                                    <option value="{{ $clase->idClaseProducto }}"
                                        {{ old('idClaseProducto') == $clase->idClaseProducto ? 'selected' : '' }}>
                                        {{ $clase->nombreClase }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

    <!-- Género del producto -->
<div class="mb-3">
    <label for="idSexoProducto" class="form-label">Género del Producto</label>
    <select name="idSexoProducto" id="idSexoProducto" class="form-select" required>
        @foreach ($generos as $genero)
            <option value="{{ $genero->idSexoProducto }}" {{ old('idSexoProducto') == $genero->idSexoProducto ? 'selected' : '' }}>
                {{ $genero->nombre_sexo }}
            </option>
        @endforeach
    </select>
</div>
                        <!-- Estado del producto -->
                        <div class="mb-3">
                            <label for="idEstadoProducto" class="form-label">Estado del Producto</label>
                            <select name="idEstadoProducto" id="idEstadoProducto" class="form-select" required>
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->idEstadoProducto }}"
                                        {{ old('idEstadoProducto') == $estado->idEstadoProducto ? 'selected' : '' }}>
                                        {{ $estado->estado }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Código identificador -->
                        <div class="mb-3">
                            <label for="codigoIdentificador" class="form-label">Código Identificador</label>
                            <input type="text" name="codigoIdentificador" id="codigoIdentificador"
                                   class="form-control @error('codigoIdentificador') is-invalid @enderror"
                                   value="{{ old('codigoIdentificador') }}" required>
                            @error('codigoIdentificador')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

<!-- Marca del producto -->
<div class="mb-3">
    <label for="id_marca" class="form-label">Marca del Producto</label>
    <select name="id_marca" id="id_marca" class="form-select">
        <option value="">Sin marca</option>
        @foreach ($marcas as $marca)
            <option value="{{ $marca->id_marca }}" {{ old('id_marca') == $marca->id_marca ? 'selected' : '' }}>
                {{ $marca->nombre_marca }}
            </option>
        @endforeach
    </select>
</div>

                        <!-- Destacado -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="destacado" id="destacado" class="form-check-input"
                                {{ old('destacado') ? 'checked' : '' }}>
                            <label for="destacado" class="form-check-label">¿Producto destacado?</label>
                        </div>

              
<!-- Tipo de oferta -->
<div class="mb-3">
    <label for="idTipoOferta" class="form-label">Tipo de Oferta</label>
    <select name="idTipoOferta" id="idTipoOferta" class="form-select">
        <option value="">Sin tipo de oferta</option>
        @foreach ($tiposOferta as $tipo)
            <option value="{{ $tipo->idTipoOferta }}" {{ old('idTipoOferta') == $tipo->idTipoOferta ? 'selected' : '' }}>
                {{ $tipo->nombreTipo }}
            </option>
        @endforeach
    </select>
</div>

                        <!-- Valor de oferta -->
                        <div class="mb-3">
                            <label for="valor_oferta" class="form-label">Valor de la Oferta (si aplica)</label>
                            <input type="number" name="valor_oferta" id="valor_oferta" step="0.01"
                                   class="form-control" value="{{ old('valor_oferta') }}">
                        </div>

                        <!-- Fechas de oferta -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fecha_inicio_oferta" class="form-label">Fecha de Inicio de Oferta</label>
                                <input type="datetime-local" name="fecha_inicio_oferta" id="fecha_inicio_oferta"
                                       class="form-control" value="{{ old('fecha_inicio_oferta') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_fin_oferta" class="form-label">Fecha de Finalización de Oferta</label>
                                <input type="datetime-local" name="fecha_fin_oferta" id="fecha_fin_oferta"
                                       class="form-control" value="{{ old('fecha_fin_oferta') }}">
                            </div>
                        </div>

                        <!-- ID del administrador de oferta -->
                        <div class="mb-3">
                            <label for="id_administrador_oferta" class="form-label">Administrador que gestiona la oferta</label>
                            <select name="id_administrador_oferta" id="id_administrador_oferta" class="form-select">
                                <option value="">Ninguno</option>
                                @foreach ($admins as $admin)
                                    <option value="{{ $admin->id_administrador }}"
                                        {{ old('id_administrador_oferta') == $admin->id_administrador ? 'selected' : '' }}>
                                        {{ $admin->nombres }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Acciones -->
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-success">Guardar Producto</button>
                            <a href="{{ route('admin.productos.index') }}" class="btn btn-outline-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection