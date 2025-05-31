<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('administradores')->user();
        return view('admin.perfil.index', compact('admin'));
    }

    public function edit()
    {
        $admin = Auth::guard('administradores')->user();
        return view('admin.perfil.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('administradores')->user();
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:administradores,email,'.$admin->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $admin->update($request->only(['nombre', 'email']));
        
        if ($request->filled('password')) {
            $admin->update(['password' => bcrypt($request->password)]);
        }

        return redirect()->route('admin.perfil.index')->with('success', 'Perfil actualizado correctamente');
    }
}