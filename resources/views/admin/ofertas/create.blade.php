@extends('admin.layouts.app')

@section('title', 'Crear Nueva Oferta')
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Ofertas', 'url' => route('admin.productos.ofertas.index')],
['name' => 'Nueva Oferta']
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4>Nueva Oferta</h4>

                    <form method="POST" action="{{ route('admin.productos.ofertas.store') }}">
                        @csrf

                        <!-- Producto -->
                        <div class="mb-3">
                            <label for="idProducto" class="form-label">Producto</label>
                            <select name="idProducto" id="idProducto" class="form-select" required>
                                <option value="">Selecciona un producto</option>
                                @foreach ($productos as $producto)
                                <option value="{{ $producto->idProducto }}">{{ $producto->nombreProducto }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Estado de la oferta -->
                        <div class="mb-3">
                            <label for="idEstadoOferta" class="form-label">Estado de la Oferta</label>
                            <select name="idEstadoOferta" id="idEstadoOferta" class="form-select" required>
                                <option value="">Selecciona estado</option>
                                @foreach ($estadosOferta as $estado)
                                <option value="{{ $estado->idEstadoOferta }}">{{ $estado->nombreEstado }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tipo de oferta -->
                        <div class="mb-3">
                            <label for="idTipoOferta" class="form-label">Tipo de Oferta</label>
                            <select name="idTipoOferta" id="idTipoOferta" class="form-select" required>
                                <option value="">Selecciona tipo</option>
                                @foreach ($tiposOferta as $tipo)
                                <option value="{{ $tipo->idTipoOferta }}">{{ $tipo->nombreTipo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Valor de descuento -->
                        <div class="mb-3">
                            <label for="valor_oferta" class="form-label">Valor del Descuento</label>
                            <input type="number" name="valor_oferta" id="valor_oferta" class="form-control" step="0.01"
                                required>
                        </div>

                        <!-- Fechas -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fecha_inicio_oferta" class="form-label">Fecha de Inicio</label>
                                <input type="datetime-local" name="fecha_inicio_oferta" id="fecha_inicio_oferta"
                                    class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_fin_oferta" class="form-label">Fecha de Finalización</label>
                                <input type="datetime-local" name="fecha_fin_oferta" id="fecha_fin_oferta"
                                    class="form-control">
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