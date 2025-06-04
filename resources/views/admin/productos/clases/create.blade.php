@extends('admin.layouts.app')

@section('title', 'Crear Clase de Producto')


@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.productos.classes.index') }}">Clases de Producto</a></li>
    <li class="breadcrumb-item active">Crear</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            @include('admin.productos.clases.form', [
                'title' => 'Crear Nueva Clase de Producto',
                'action' => route('admin.productos.classes.store'),
                'clase' => new App\Models\admin\ClassProduct(),
                'method' => 'POST'
            ])
        </div>
    </div>
</div>
@endsection