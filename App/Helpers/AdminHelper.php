<?php

if (!function_exists('admin_user')) {
    function admin_user() {
        // Obtener el usuario autenticado usando el guard 'administradores'
        $user = auth()->guard('administradores')->user();
        
        // Si no hay usuario autenticado, devolver un objeto por defecto
        if (!$user) {
            return (object)[
                'name' => 'Administrador',
                'photo_url' => 'https://ui-avatars.com/api/?name=Admin&background=2d5a3d&color=fff'
            ];
        }
        
        // Completar datos faltantes con valores por defecto
        $user->photo_url = $user->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=2d5a3d&color=fff';
        
        return $user;
    }
}
