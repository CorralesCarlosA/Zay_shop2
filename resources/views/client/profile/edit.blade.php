@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Perfil</h1>
    
    <form method="POST" action="{{ route('client.perfil.update') }}">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        
        <!-- Agrega más campos según tu modelo User -->
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('client.perfil.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection