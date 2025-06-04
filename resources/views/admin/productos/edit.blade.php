@extends('admin.layouts.app')

@section('title', 'Editar Producto #' . $producto->idProducto)
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.productos.index') }}">Productos</a></li>
        <li class="breadcrumb-item active">Editar #{{ $producto->idProducto }}</li>
    </ol>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4>Actualizar Producto #{{ $producto->idProducto }}</h4>

                    <form method="POST" action="{{ route('admin.productos.update', $producto->idProducto) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombreProducto" class="form-label">Nombre del Producto</label>
                            <input type="text" name="nombreProducto" id="nombreProducto" class="form-control"
                                value="{{ old('nombreProducto', $producto->nombreProducto) }}" required>
                        </div>
                        <!-- campo marca -->
                        <div class="mb-3">
                            <label for="id_marca" class="form-label">Marca</label>
                            <select name="id_marca" id="id_marca" class="form-select">
                                <option value="">Selecciona una marca</option>
                                @foreach ($marcas as $marca)
                                <option value="{{ $marca->id_marca }}"
                                    {{ $producto->id_marca == $marca->id_marca ? 'selected' : '' }}>
                                    {{ $marca->nombre_marca }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcionProducto" class="form-label">Descripción</label>
                            <textarea name="descripcionProducto" id="descripcionProducto" class="form-control"
                                rows="4">{{ old('descripcionProducto', $producto->descripcionProducto) }}</textarea>
                        </div>

                        <!-- Precio -->
                        <div class="mb-3">
                            <label for="precioProducto" class="form-label">Precio</label>
                            <input type="number" name="precioProducto" id="precioProducto" class="form-control"
                                step="0.01" value="{{ old('precioProducto', $producto->precioProducto) }}" required>
                        </div>

                        <!-- Código Identificador -->
                        <div class="mb-3">
                            <label for="codigoIdentificador" class="form-label">Código Identificador</label>
                            <input type="text" name="codigoIdentificador" id="codigoIdentificador" class="form-control"
                                value="{{ old('codigoIdentificador', $producto->codigoIdentificador) }}" required>
                        </div>

                        <!-- Categoría -->
                        <div class="mb-3">
                            <label for="id_categoria" class="form-label">Categoría</label>
                            <select name="id_categoria" id="id_categoria" class="form-select">
                                <option value="">Selecciona una categoría</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}"
                                    {{ $producto->id_categoria == $categoria->id_categoria ? 'selected' : '' }}>
                                    {{ $categoria->nombre_categoria }}
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
                                    {{ $producto->idClaseProducto == $clase->idClaseProducto ? 'selected' : '' }}>
                                    {{ $clase->nombreClaseProducto }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Género del producto -->
                        <div class="mb-3">
                            <label for="idSexoProducto" class="form-label">Género del Producto</label>
                            <select name="idSexoProducto" id="idSexoProducto" class="form-select" required>
                                @foreach ($generos as $sexo)
                                <option value="{{ $sexo->idSexoProducto }}"
                                    {{ $producto->idSexoProducto == $sexo->idSexoProducto ? 'selected' : '' }}>
                                    {{ $sexo->nombreSexo }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Color -->
                        <div class="mb-3">
                            <label for="idColor" class="form-label">Color</label>
                            <select name="idColor" id="idColor" class="form-select" required>
                                @foreach ($colores as $color)
                                <option value="{{ $color->idColor }}"
                                    {{ $producto->idColor == $color->idColor ? 'selected' : '' }}>
                                    {{ $color->nombreColor }}
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
                                    {{ $producto->idEstadoProducto == $estado->idEstadoProducto ? 'selected' : '' }}>
                                    {{ $estado->estado }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Talla -->
                        <div class="mb-3">
                            <label for="tallaProducto" class="form-label">Talla (opcional)</label>
                            <select name="tallaProducto" id="tallaProducto" class="form-select">
                                <option value="">Selecciona talla</option>
                                @foreach (\App\Models\admin\Size::all() as $talla)
                                <option value="{{ $talla->id_talla }}"
                                    {{ $producto->tallaProducto == $talla->id_talla ? 'selected' : '' }}>
                                    {{ $talla->nombre_talla }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botón de actualizar -->
                        <button type="submit" class="btn btn-primary w-100">Actualizar Producto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection