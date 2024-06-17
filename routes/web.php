<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PiscinaController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\AdminUserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();


// La ruta del calendario

Route::get('/calendario', function () {
    return view('calendario');
})->name('calendario');


//La ruta de la pagina principal

Route::get('/home', function () {
    return view('home');
})->name('home');

//Ruta del perfil de usuario, si no esta Logueado se le pedira que se loguee
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

//Dentro del perfil tenemos la ruta para ver el perfil, que contiene informacion basica, de cuando se creo la cuenta y datos, y luego otra vista de sus reservas
Route::get('/perfil', function () {
    return view('usuarios.perfil');
})->name('perfil');

Route::get('/reservas', [ReservasController::class, 'index'])->name('reservas.index');



// Ruta para la creacion y eliminacion de citas
Route::middleware('auth')->group(function () {
    Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');
    Route::delete('/citas/{cita}', [CitaController::class, 'destroy'])->name('citas.destroy');
});

Route::get('/citas/reservas',  [CitaController::class, 'reservasUsuario'])->name('citas.reservas');


//Obtener todas las citas, es un json
Route::get('/citas', [CitaController::class, 'getAllCitas']);

//Distintas rutas para un usuario nuevo
Route::get('/help', function () {
    return view('ayuda.help');
})->name('help');

Route::get('/help/material', function () {
    return view('ayuda.material');
})->name('natacion.material');

Route::get('/help/entrenamiento', function () {
    return view('ayuda.natacion');
})->name('natacion.entrenamiento');

Route::get('/help/app', function () {
    return view('ayuda.app');
})->name('ayuda.app');

//Ruta para crear un usuario 
Route::middleware('role:' . \App\Enums\Role::ADMIN)->group(function () {
    // Ruta para mostrar el formulario de creación de usuarios administradores
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');

    // Ruta para almacenar un nuevo usuario administrador en la base de datos
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');

});
//Eliminar usuarios 




//Ruta para ver todos los usuarios registrados(solo admin)
Route::middleware('role:' . \App\Enums\Role::ADMIN)->group(function () {
    // Otras rutas...

    // Ruta para ver todos los usuarios
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.index');
});

//ayuda admin
Route::get('/ayuda/admin', function () {
    return view('ayuda.admin');
})->middleware(['auth', 'role:Admin'])->name('ayuda.admin');
