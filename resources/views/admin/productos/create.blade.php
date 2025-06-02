@extends('admin.layouts.app')
@section('title', 'Crear Nuevo Producto')
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
<li class="breadcrumb-item active" aria-current="page">Productos</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4>Datos del Producto</h4>

                    <form method="POST" action="{{ route('admin.productos.store') }}" id="productForm" enctype="multipart/form-data">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombreProducto" class="form-label">Nombre del Producto</label>
                            <input type="text" name="nombreProducto" id="nombreProducto" class="form-control" required>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcionProducto" class="form-label">Descripción</label>
                            <textarea name="descripcionProducto" id="descripcionProducto" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Precio -->
                        <div class="mb-3">
                            <label for="precioProducto" class="form-label">Precio</label>
                            <input type="number" name="precioProducto" id="precioProducto" class="form-control" step="0.01" required>
                        </div>

                        <!-- Código Identificador -->
                        <div class="mb-3">
                            <label for="codigoIdentificador" class="form-label">Código Identificador</label>
                            <input type="text" name="codigoIdentificador" id="codigoIdentificador" class="form-control" required>
                        </div>

                        <!-- Categoría -->
                        <div class="mb-3">
                            <label for="id_categoria" class="form-label">Categoría</label>
                            <select name="id_categoria" id="id_categoria" class="form-select">
                                <option value="">Selecciona una categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombreCategoria }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Marca -->
                        <div class="mb-3">
                            <label for="id_marca" class="form-label">Marca</label>
                            <select name="id_marca" id="id_marca" class="form-select">
                                <option value="">Selecciona una marca</option>
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id_marca }}">{{ $marca->nombreMarca }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Clase de Producto -->
                        <div class="mb-3">
                            <label for="idClaseProducto" class="form-label">Clase de Producto</label>
                            <select name="idClaseProducto" id="idClaseProducto" class="form-select" required>
                                <option value="">Selecciona clase de producto</option>
                                @foreach ($clases as $clase)
                                    <option value="{{ $clase->idClaseProducto }}">{{ $clase->nombreClaseProducto }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Género del Producto -->
                        <div class="mb-3">
                            <label for="idSexoProducto" class="form-label">Género del Producto</label>
                            <select name="idSexoProducto" id="idSexoProducto" class="form-select" required>
                                <option value="">Selecciona género</option>
                                @foreach ($generos as $genero)
                                    <option value="{{ $genero->idSexoProducto }}">{{ $genero->sexo }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">¿No ves el género que necesitas?</small>
                        </div>

                        <!-- Agregar nuevo género -->
                        <div class="mb-3">
                            <label for="new_genero" class="form-label">Agregar Nuevo Género</label>
                            <input type="text" name="new_genero" id="new_genero" class="form-control" placeholder="Ejemplo: Niños">
                        </div>

                        <!-- Color -->
                        <div class="mb-3">
                            <label for="colores" class="form-label">Colores Disponibles</label>
                            <select name="colores[]" id="colores" class="form-select" multiple required>
                                @foreach ($colores as $color)
                                    <option value="{{ $color->idColor }}">{{ $color->nombreColor }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Puedes seleccionar múltiples colores.</small>
                        </div>

                        <!-- Agregar nuevo color -->
                        <div class="mb-3">
                            <label for="new_color" class="form-label">Agregar Nuevo Color</label>
                            <input type="text" name="new_color" id="new_color" class="form-control" placeholder="Ejemplo: Dorado">
                        </div>

                        <!-- Tallas -->
                        <div class="mb-3">
                            <label for="tallas" class="form-label">Tallas Disponibles</label>
                            <select name="tallas[]" id="tallas" class="form-select" multiple>
                                @foreach ($tallas as $talla)
                                    <option value="{{ $talla->id_talla }}">{{ $talla->nombre_talla }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Puedes seleccionar múltiples tallas.</small>
                        </div>

                        <!-- Agregar nueva talla -->
                        <div class="mb-3">
                            <label for="new_talla" class="form-label">Agregar Nueva Talla</label>
                            <input type="text" name="new_talla" id="new_talla" class="form-control" placeholder="Ejemplo: XL">
                        </div>

                        <!-- Estado del Producto -->
                        <div class="mb-3">
                            <label for="idEstadoProducto" class="form-label">Estado del Producto</label>
                            <select name="idEstadoProducto" id="idEstadoProducto" class="form-select" required>
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->idEstadoProducto }}">{{ $estado->estado }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Cantidad Disponible -->
                        <div class="mb-3">
                            <label for="cantidadDisponible" class="form-label">Cantidad Disponible</label>
                            <input type="number" name="cantidadDisponible" id="cantidadDisponible" class="form-control" min="1" required>
                            <small class="form-text text-muted">Define la cantidad disponible para este producto.</small>
                        </div>

                        <!-- Imágenes generales -->
                        <div class="mb-3">
                            <label for="imagenes" class="form-label">Imágenes del Producto</label>
                            <input type="file" name="imagenes[]" id="imagenes" class="form-control" multiple accept="image/*">
                            <small class="form-text text-muted">Puedes subir varias imágenes del producto.</small>
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" class="btn btn-success w-100">Guardar Producto(s)</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection