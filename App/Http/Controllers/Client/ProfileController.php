<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('client.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('client.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            // Agrega más campos según necesites
        ]);

        $user->update($validated);

        return redirect()->route('client.perfil.index')
                         ->with('success', 'Perfil actualizado correctamente');
    }
}