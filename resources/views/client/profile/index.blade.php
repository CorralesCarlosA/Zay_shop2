@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mi Perfil</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Información del Usuario</h5>
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <!-- Agrega más campos según tu modelo User -->
            
            <a href="{{ route('client.perfil.edit') }}" class="btn btn-primary">Editar Perfil</a>
        </div>
    </div>
</div>
@endsection