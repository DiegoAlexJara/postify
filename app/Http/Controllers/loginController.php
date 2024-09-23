<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

use function Laravel\Prompts\password;

class loginController extends Controller
{
    public function showlogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $credenciales = $request->only('email', 'password');

        if (!Auth::attempt($credenciales)) {

            return redirect()->route('showlogin')->with('error', 'Credenciales Incorrectas');
        }

        return redirect()->intended('inicio');
    }

    public function outlogin(Request $request)
    {
        // Cerrar la sesión del usuario
        Auth::logout();

        // Invalidar la sesión actual
        $request->session()->invalidate();

        // Regenerar el token de la sesión
        $request->session()->regenerateToken();

        // Redirigir al usuario a la página de inicio u otra página
        return redirect()->route('showlogin');
    }

    public function NewUser() 
    {
        return view('NewUser');
    }

    public function CrearUsuario(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => ['required', 'confirmed', Password::defaults()]
        ]);
        $user = User::create($request->all());

        return redirect()->route('login')->with('success', 'Cuenta Creada');
    }
    
}
