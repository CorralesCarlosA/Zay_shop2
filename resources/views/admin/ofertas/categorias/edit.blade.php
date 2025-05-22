@extends('admin.layouts.app')

@section('title', 'Editar Oferta por Categoría #' . $oferta->id_oferta_categoria)
@section('breadcrumbs', [
['name' => 'Inicio', 'url' => route('admin.dashboard')],
['name' => 'Ofertas por Categoría', 'url' => route('admin.ofertas.categoria.index')],
['name' => 'Editar #' . $oferta->id_oferta_categoria]
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4>Actualizar Oferta #{{ $oferta->id_oferta_categoria }}</h4>

                    <form method="POST"
                        action="{{ route('admin.ofertas.categoria.update', $oferta->id_oferta_categoria) }}">
                        @csrf
                        @method('PUT')

                        <!-- Categoría -->
                        <div class="mb-3">
                            <label for="id_categoria" class="form-label">Categoría</label>
                            <select name="id_categoria" id="id_categoria" class="form-select" disabled>
                                <option value="{{ $oferta->category->id_categoria }}" selected>
                                    {{ $oferta->category->nombre_categoria }}
                                </option>
                            </select>
                        </div>

                        <!-- Estado de la oferta -->
                        <div class="mb-3">
                            <label for="idEstadoOferta" class="form-label">Estado de la Oferta</label>
                            <select name="idEstadoOferta" id="idEstadoOferta" class="form-select" required>
                                @foreach ($estados as $estado)
                                <option value="{{ $estado->idEstadoOferta }}"
                                    {{ $oferta->idEstadoOferta == $estado->idEstadoOferta ? 'selected' : '' }}>
                                    {{ $estado->nombreEstado }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tipo de oferta -->
                        <div class="mb-3">
                            <label for="idTipoOferta" class="form-label">Tipo de Oferta</label>
                            <select name="idTipoOferta" id="idTipoOferta" class="form-select" required>
                                @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->idTipoOferta }}"
                                    {{ $oferta->idTipoOferta == $tipo->idTipoOferta ? 'selected' : '' }}>
                                    {{ $tipo->nombreTipo }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Valor del descuento -->
                        <div class="mb-3">
                            <label for="valor_oferta" class="form-label">Valor del Descuento</label>
                            <input type="number" name="valor_oferta" id="valor_oferta" class="form-control" step="0.01"
                                value="{{ old('valor_oferta', $oferta->valor_oferta) }}" required>
                        </div>

                        <!-- Fechas -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                                    value="{{ old('fecha_inicio', $oferta->fecha_inicio) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_fin" class="form-label">Fecha de Finalización</label>
                                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"
                                    value="{{ old('fecha_fin', $oferta->fecha_fin) }}" required>
                            </div>
                        </div>

                        <!-- Botón de actualizar -->
                        <button type="submit" class="btn btn-primary w-100 mt-3">Actualizar Oferta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection