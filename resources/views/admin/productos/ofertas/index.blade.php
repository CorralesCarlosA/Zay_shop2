@extends('admin.layouts.app')
@section('title', 'Ofertas')
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.productos.index') }}">Productos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ofertas</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card shadow-sm border-0 mt-5">
                <div class="card-body py-5">
                    <h1 class="display-4 fw-bold text-danger">
                        OFERTAS DISPONIBLES EN PRÓXIMAS ACTUALIZACIONES
                    </h1>
                    <p class="lead mt-3 text-muted">
                        Esta sección estará disponible pronto. Mientras tanto, puedes gestionar tus productos desde el menú principal.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('admin.productos.index') }}" class="btn btn-outline-secondary">
                            Volver a Productos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



