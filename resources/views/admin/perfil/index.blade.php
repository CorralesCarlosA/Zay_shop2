@extends('components.admin.layout')

@section('title', 'Mi Perfil')

@section('header', 'Mi Perfil')

@section('content')
<div class="max-w-3xl mx-auto">
    <x-admin.card>
        <div class="flex items-center space-x-4">
            <div class="flex-shrink-0 h-16 w-16 rounded-full overflow-hidden bg-gray-200">
                @if($admin->avatar)
                    <img class="h-full w-full object-cover" src="{{ $admin->avatar }}" alt="{{ $admin->nombre }}">
                @else
                    <x-icons.user class="h-full w-full text-gray-400"/>
                @endif
            </div>
            <div>
                <h3 class="text-lg font-medium text-gray-900">{{ $admin->nombre }}</h3>
                <p class="text-sm text-gray-500">{{ $admin->email }}</p>
                <p class="text-sm text-gray-500 mt-1">Administrador desde {{ $admin->created_at->format('d/m/Y') }}</p>
            </div>
        </div>

        <div class="mt-6 border-t border-gray-200 pt-6">
            <dl class="divide-y divide-gray-200">
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Nombre completo</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $admin->nombre }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Correo electrónico</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $admin->email }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Rol</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">Administrador</dd>
                </div>
            </dl>
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('admin.perfil.edit') }}" class="btn btn-primary">
                Editar perfil
            </a>
        </div>
    </x-admin.card>
</div>
@endsection