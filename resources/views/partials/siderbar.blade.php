<!-- resources/views/partials/sidebar_filtros.blade.php -->

<h5>Filtrar Productos</h5>
<form id="form-filtros" method="GET" action="#" class="mb-4">

    <!-- Categoría -->
    <div class="mb-3">
        <label for="categoria" class="form-label">Categoría</label>
        <select name="categoria" id="categoria" class="form-select">
            <option value="">Todas las categorías</option>
            @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
            @endforeach
        </select>
    </div>

    <!-- Color -->
    <div class="mb-3">
        <label for="color" class="form-label">Color</label>
        <select name="color" id="color" class="form-select">
            <option value="">Todos los colores</option>
            @foreach ($colores as $color)
            <option value="{{ $color->idColor }}">{{ $color->nombreColor }}</option>
            @endforeach
        </select>
    </div>

    <!-- Talla -->
    <div class="mb-3">
        <label for="talla" class="form-label">Talla</label>
        <select name="talla" id="talla" class="form-select">
            <option value="">Todas las tallas</option>
            @foreach ($tallas as $talla)
            <option value="{{ $talla->id_talla }}">{{ $talla->nombre_talla }}</option>
            @endforeach
        </select>
    </div>

    <!-- Género -->
    <div class="mb-3">
        <label for="sexo" class="form-label">Género</label>
        <select name="sexo" id="sexo" class="form-select">
            <option value="">Todos</option>
            @foreach ($sexos as $sexo)
            <option value="{{ $sexo->idSexoProducto }}">{{ $sexo->nombre_sexo }}</option>
            @endforeach
        </select>
    </div>

    <!-- Clase de producto -->
    <div class="mb-3">
        <label for="clase" class="form-label">Tipo de Producto</label>
        <select name="clase" id="clase" class="form-select">
            <option value="">Todos</option>
            @foreach ($clases as $clase)
            <option value="{{ $clase->idClaseProducto }}">{{ $clase->nombreClase }}</option>
            @endforeach
        </select>
    </div>

    <!-- Ofertas -->
    <div class="mb-3 form-check">
        <input type="checkbox" name="en_oferta" id="en_oferta" class="form-check-input" value="1">
        <label for="en_oferta" class="form-check-label">Solo en oferta</label>
    </div>

    <!-- Rango de precios -->
    <div class="row g-2 mb-3">
        <div class="col">
            <input type="number" name="min_precio" id="min_precio" class="form-control" placeholder="Min" min="0"
                step="1000">
        </div>
        <div class="col">
            <input type="number" name="max_precio" id="max_precio" class="form-control" placeholder="Max" min="0"
                step="1000">
        </div>
    </div>

    <!-- Botón de filtro -->
    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
</form>