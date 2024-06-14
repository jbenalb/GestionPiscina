<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\Role;
use App\Models\Cita;

class AdminUserController extends Controller
{
    // Método para mostrar el formulario de creación de usuarios administradores
    public function create()
    {
        return view('admin.create');
    }

    // Método para almacenar un nuevo usuario administrador en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Crear el nuevo usuario con el rol de administrador
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Asignar el rol de administrador al usuario
        $user->assignRole(Role::ADMIN);

        // Redireccionar a alguna vista o acción
        return redirect()->route('dashboard')->with('success', 'Usuario administrador creado correctamente');
    }
    
 

    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }
      // Método para mostrar el formulario de edición de usuario
      public function edit($id)
      {
          $user = User::findOrFail($id);
          return view('admin.edit', compact('user'));
      }
  
      // Método para actualizar la información del usuario
      public function update(Request $request, $id)
      {
          // Validar los datos del formulario
          $validatedData = $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|string|email|unique:users,email,' . $id,
              'password' => 'nullable|string|min:8',
          ]);
  
          // Buscar el usuario y actualizar sus datos
          $user = User::findOrFail($id);
          $user->name = $validatedData['name'];
          $user->email = $validatedData['email'];
          if (!empty($validatedData['password'])) {
              $user->password = bcrypt($validatedData['password']);
          }
          $user->save();
  
          // Redireccionar a la vista de usuarios con un mensaje de éxito
          return redirect()->route('admin.index')->with('success', 'Usuario actualizado correctamente');
      }
    public function destroy($id)
    {
        // Buscar el usuario por ID y eliminarlo
        $user = User::findOrFail($id);
        $user->delete();

        // Redireccionar a la vista de usuarios con un mensaje de éxito
        return redirect()->route('admin.index')->with('success', 'Usuario eliminado correctamente');
    }
}


