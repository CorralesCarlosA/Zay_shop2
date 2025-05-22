@extends('admin.layouts.app')

@section('title', 'Crear Nueva Oferta por Categoría')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Ofertas por Categoría', 'url' => route('admin.ofertas.categoria.index')],
['name' => 'Nuevo']
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4>Nueva Oferta por Categoría</h4>

                    <form method="POST" action="{{ route('admin.ofertas.categoria.store') }}">
                        @csrf

                        <!-- Categoría -->
                        <div class="mb-3">
                            <label for="id_categoria" class="form-label">Categoría</label>
                            <select name="id_categoria" id="id_categoria" class="form-select" required>
                                <option value="">Selecciona una categoría</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Estado de la oferta -->
                        <div class="mb-3">
                            <label for="idEstadoOferta" class="form-label">Estado de la Oferta</label>
                            <select name="idEstadoOferta" id="idEstadoOferta" class="form-select" required>
                                <option value="">Selecciona un estado</option>
                                @foreach ($estados as $estado)
                                <option value="{{ $estado->idEstadoOferta }}">{{ $estado->nombreEstado }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tipo de oferta -->
                        <div class="mb-3">
                            <label for="idTipoOferta" class="form-label">Tipo de Oferta</label>
                            <select name="idTipoOferta" id="idTipoOferta" class="form-select" required>
                                <option value="">Selecciona tipo de oferta</option>
                                @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->idTipoOferta }}">{{ $tipo->nombreTipo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Valor del descuento -->
                        <div class="mb-3">
                            <label for="valor_oferta" class="form-label">Valor del Descuento</label>
                            <input type="number" name="valor_oferta" id="valor_oferta" class="form-control" step="0.01"
                                min="0.01" required>
                        </div>

                        <!-- Fechas -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_fin" class="form-label">Fecha de Finalización</label>
                                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                            </div>
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" class="btn btn-success w-100">Guardar Oferta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection