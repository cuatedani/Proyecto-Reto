<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //VISTAS

    //PERFIL
    //MOSTRAR VISTA VER PERFIL
    public function profileView(Request $request){
        $user = $request->user();
        return view('profile.show', compact('user'));
    }

    //ACTUALIZAR UN USUARIO ESPECIFICO
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
        ], [
            'name.max' => 'El nombre no debe exceder los 255 caracteres',
            'email.email' => 'El correo no es válido',
            'email.unique' => 'Este correo ya está registrado',
            'email.max' => 'El correo no debe exceder los 255 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('profile.show')
            ->with('success', 'Perfil actualizado correctamente');
    }

    //USUARIOS
    //MOSTRAR LISTA DE USUARIOS
    public function indexView(Request $request)
    {
        $search = $request->query('search');
        $usersQuery = User::select('id', 'name', 'email', 'role', 'created_at')
            ->orderBy('created_at', 'desc');

        if ($search) {
            $usersQuery->where('name', 'like', '%' . $search . '%');
        }

        $users = $usersQuery->paginate(10)->withQueryString();

        return view('users.index', compact('users', 'search'));
    }

    //VER UN USUARIO
    public function showView(User $user)
    {
        return view('users.show', compact('user'));
    }


    //MOSTRAR VISTA CREAR USUARIO
    public function createView(){
        return view('users.create');
    }

    //MOSTRAR VISTA EDITAR USUARIO
    public function editView(User $user){
        return view('users.edit', compact('user'));
    }

    //ACCIONES

    //CREAR NUEVO USUARIO
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin',
        ], [
            'name.required' => 'El nombre es obligatorio',

            'email.required' => 'El correo es obligatorio',
            'email.email' => 'El correo no es válido',
            'email.unique' => 'Este correo ya está registrado',

            'role.required' => 'El rol es obligatorio',
            'role.in' => 'El rol debe ser user o admin',

            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuario creado correctamente');
    }

    //ACTUALIZAR UN USUARIO ESPECIFICO
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'sometimes|in:user,admin',
        ], [
            'name.max' => 'El nombre no debe exceder los 255 caracteres',

            'email.email' => 'El correo no es válido',
            'email.unique' => 'Este correo ya está registrado',
            'email.max' => 'El correo no debe exceder los 255 caracteres',

            'role.in' => 'El rol debe ser user o admin',
        ]);

        if ($request->has('role') && $user->id === $request->user()->id) {
            return back()->withErrors('No puedes cambiar tu propio rol');
        }

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    //ELIMINAR UN USUARIO ESPECIFICO
    public function destroyUser(Request $request, User $user)
    {

        if ($user->id === $request->user()->id) {
            return redirect()
                ->back()
                ->withErrors('No puedes eliminar tu propio usuario');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}
