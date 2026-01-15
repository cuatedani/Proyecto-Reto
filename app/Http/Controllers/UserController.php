<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        if($users->isEmpty()){
            return response()->json(['message' => 'No hay usuarios registrados'], 404);
        }
        return response()->json($users, 200);
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function create(){
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:user,admin'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return response()->json($user, 201);
    }

    public function edit(Request $request, $id){
        return view('users.edit');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'role' => 'sometimes|in:user,admin'
        ]);

        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy($id)
    {
        User::destroy($id);
        if (!User::find($id)) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        return response()->json(['message' => 'Usuario eliminado'], 200 );
    }
}
