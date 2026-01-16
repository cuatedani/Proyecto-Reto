<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    //MOSTRAR LA VISTA DEL LOGIN
    public function loginView(){
        return view('auth.login');
    }

    //REALIZAR LOGIN
    public function loginWeb(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'El correo no es válido',
            'password.required' => 'La contraseña es obligatoria',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return back()
                ->withErrors(['email' => 'Las credenciales no son correctas'])
                ->withInput($request->only('email'));
        }

        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }

    //MOSTRAR LA VISTA DE REGISTRO
    public function registerView(){
        return view('auth.register');
    }

    //PROCESAR EL REGISTRO
    public function registerWeb(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'El nombre es obligatorio',
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'El correo no es válido',
            'email.unique' => 'Este correo ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    //MOSTRAR LA VISTA DE RECUPERACION DE ACCESO
    public function recoveryView(){
        return view('auth.recovery');
    }

    //PROCESAR LA RECUPERACION DE ACCESO
    public function recoveryWeb(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'El correo no es válido',
            'email.exists' => 'No existe una cuenta con este correo',
        ]);

        return back()->with('status', 'Te hemos enviado instrucciones a tu correo');
    }

    //CERRAR SESION EN EL SITIO
    public function logoutWeb(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
