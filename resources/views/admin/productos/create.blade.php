@extends('admin.layouts.app')

@section('title', 'Crear Nuevo Producto')


@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Inicio</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Productos</li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4>Datos del Producto</h4>

                    <form method="POST" action="{{ route('admin.productos.store') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombreProducto" class="form-label">Nombre del Producto</label>
                            <input type="text" name="nombreProducto" id="nombreProducto" class="form-control" required
                                autofocus>
                        </div>
                        <!-- Campo de marca -->
                        <div class="mb-3">
                            <label for="id_marca" class="form-label">Marca</label>
                            <select name="id_marca" id="id_marca" class="form-select">
                                <option value="">Selecciona una marca</option>
                                @foreach ($marcas as $marca)
                                <option value="{{ $marca->id_marca }}"
                                    {{ old('id_marca') == $marca->id_marca ? 'selected' : '' }}>
                                    {{ $marca->nombre_marca }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcionProducto" class="form-label">Descripción</label>
                            <textarea name="descripcionProducto" id="descripcionProducto" class="form-control"
                                rows="4"></textarea>
                        </div>

                        <!-- Precio -->
                        <div class="mb-3">
                            <label for="precioProducto" class="form-label">Precio</label>
                            <input type="number" name="precioProducto" id="precioProducto" class="form-control"
                                step="0.01" required>
                        </div>

                        <!-- Código Identificador -->
                        <div class="mb-3">
                            <label for="codigoIdentificador" class="form-label">Código Identificador</label>
                            <input type="text" name="codigoIdentificador" id="codigoIdentificador" class="form-control"
                                required>
                        </div>

                        <!-- Categoría -->
                        <div class="mb-3">
                            <label for="id_categoria" class="form-label">Categoría</label>
                            <select name="id_categoria" id="id_categoria" class="form-select">
                                <option value="">Selecciona una categoría</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Clase de producto -->
                        <div class="mb-3">
                            <label for="idClaseProducto" class="form-label">Clase de Producto</label>
                            <select name="idClaseProducto" id="idClaseProducto" class="form-select" required>
                                <option value="">Selecciona clase de producto</option>
                                @foreach ($clases as $clase)
                                <option value="{{ $clase->idClaseProducto }}">{{ $clase->nombreClaseProducto }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sexo del producto -->
                        <div class="mb-3">
                            <label for="idSexoProducto" class="form-label">Género del Producto</label>
                            <select name="idSexoProducto" id="idSexoProducto" class="form-select" required>
                                <option value="">Selecciona género</option>
                                @foreach ($generos as $sexo)
                                <option value="{{ $sexo->idSexoProducto }}">{{ $sexo->nombreSexo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Color del producto -->
                        <div class="mb-3">
                            <label for="idColor" class="form-label">Color del Producto</label>
                            <select name="idColor" id="idColor" class="form-select" required>
                                <option value="">Selecciona un color</option>
                                @foreach ($colores as $color)
                                <option value="{{ $color->idColor }}">{{ $color->nombreColor }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Estado del producto -->
                        <div class="mb-3">
                            <label for="idEstadoProducto" class="form-label">Estado del Producto</label>
                            <select name="idEstadoProducto" id="idEstadoProducto" class="form-select" required>
                                <option value="">Selecciona estado</option>
                                @foreach ($estados as $estado)
                                <option value="{{ $estado->idEstadoProducto }}">{{ $estado->estado }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Talla -->
                        <div class="mb-3">
                            <label for="tallaProducto" class="form-label">Talla (opcional)</label>
                            <select name="tallaProducto" id="tallaProducto" class="form-select">
                                <option value="">Selecciona talla</option>
                                @foreach (\App\Models\admin\Size::all() as $talla)
                                <option value="{{ $talla->id_talla }}">{{ $talla->nombre_talla }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" class="btn btn-success w-100">Guardar Producto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection