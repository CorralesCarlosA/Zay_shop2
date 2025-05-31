@extends('components.admin.layout')

@section('title', 'Editar Perfil')

@section('header', 'Editar Perfil')

@section('content')
<div class="max-w-3xl mx-auto">
    <x-admin.card>
        <form action="{{ route('admin.perfil.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <x-admin.form.label for="nombre">Nombre completo</x-admin.form.label>
                    <x-admin.form.input 
                        type="text" 
                        name="nombre" 
                        id="nombre" 
                        value="{{ old('nombre', $admin->nombre) }}" 
                        required />
                </div>

                <div>
                    <x-admin.form.label for="email">Correo electrónico</x-admin.form.label>
                    <x-admin.form.input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', $admin->email) }}" 
                        required />
                </div>

                <div>
                    <x-admin.form.label for="password">Contraseña</x-admin.form.label>
                    <x-admin.form.input 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Dejar en blanco para no cambiar" />
                </div>

                <div>
                    <x-admin.form.label for="password_confirmation">Confirmar contraseña</x-admin.form.label>
                    <x-admin.form.input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        placeholder="Dejar en blanco para no cambiar" />
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.perfil.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    Guardar cambios
                </button>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection