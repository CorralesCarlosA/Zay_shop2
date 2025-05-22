@extends('admin.layouts.app')

@section('title', 'Editar Oferta del Producto #' . $producto->idProducto)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Ofertas', 'url' => route('admin.productos.ofertas.index')],
['name' => 'Editar #' . $producto->idProducto]
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4>Actualizar Oferta #{{ $producto->idProducto }}</h4>

                    <form method="POST" action="{{ route('admin.productos.ofertas.update', $producto->idProducto) }}">
                        @csrf
                        @method('PUT')

                        <!-- Estado de la oferta -->
                        <div class="mb-3">
                            <label for="idEstadoOferta" class="form-label">Estado de la Oferta</label>
                            <select name="idEstadoOferta" id="idEstadoOferta" class="form-select" required>
                                @foreach ($estadosOferta as $estado)
                                <option value="{{ $estado->idEstadoOferta }}"
                                    {{ $producto->idEstadoOferta == $estado->idEstadoOferta ? 'selected' : '' }}>
                                    {{ $estado->nombreEstado }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tipo de oferta -->
                        <div class="mb-3">
                            <label for="idTipoOferta" class="form-label">Tipo de Oferta</label>
                            <select name="idTipoOferta" id="idTipoOferta" class="form-select" required>
                                @foreach ($tiposOferta as $tipo)
                                <option value="{{ $tipo->idTipoOferta }}"
                                    {{ $producto->idTipoOferta == $tipo->idTipoOferta ? 'selected' : '' }}>
                                    {{ $tipo->nombreTipo }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Valor del descuento -->
                        <div class="mb-3">
                            <label for="valor_oferta" class="form-label">Valor del Descuento</label>
                            <input type="number" name="valor_oferta" id="valor_oferta" class="form-control" step="0.01"
                                value="{{ old('valor_oferta', $producto->valor_oferta) }}" required>
                        </div>

                        <!-- Fechas -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fecha_inicio_oferta" class="form-label">Fecha de Inicio</label>
                                <input type="datetime-local" name="fecha_inicio_oferta" id="fecha_inicio_oferta"
                                    class="form-control"
                                    value="{{ old('fecha_inicio_oferta', $producto->fecha_inicio_oferta?->format('Y-m-d\TH:i')) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_fin_oferta" class="form-label">Fecha de Finalización</label>
                                <input type="datetime-local" name="fecha_fin_oferta" id="fecha_fin_oferta"
                                    class="form-control"
                                    value="{{ old('fecha_fin_oferta', $producto->fecha_fin_oferta?->format('Y-m-d\TH:i')) }}">
                            </div>
                        </div>

                        <!-- Botón de actualizar -->
                        <button type="submit" class="btn btn-primary w-100">Actualizar Oferta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection