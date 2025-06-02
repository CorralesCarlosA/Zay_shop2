@extends('admin.layouts.app')

@section('title', 'Editar Clase de Producto')
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.productos.classes.index') }}">Clases de Producto</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            @include('admin.productos.classes.form', [
                'title' => 'Editar Clase de Producto: ' . $clase->nombreClase,
                'action' => route('admin.productos.classes.update', $clase->idClaseProducto),
                'method' => 'PUT',
                'clase' => $clase
            ])
        </div>
    </div>
</div>
@endsection

