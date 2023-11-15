<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AsistentesController;
use App\Http\Controllers\CategoriaEventosController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\ListaEventosController;
use App\Models\Asistentes;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Roles
Route::get('/rol/select', [RolController::class, 'selectRol']);
Route::post('/rol/store', [RolController::class, 'storeRol']);
Route::put('/rol/update/{id}', [RolController::class, 'updateRol']);
Route::get('/rol/find/{id}', [RolController::class, 'findRol']);
Route::delete('/rol/delete/{id}', [RolController::class, 'deleteRol']);

//Users
Route::get('/user/select', [UsersController::class, 'selectUser']);
Route::get('/user/select', [UsersController::class, 'verificarRegistro']);
Route::post('/user/store', [UsersController::class, 'storeUser']);
Route::put('/user/update/{id}', [UsersController::class, 'updateUser']);
Route::get('/user/find/{id}', [UsersController::class, 'findUser']);
Route::delete('/user/delete/{id}', [UsersController::class, 'deleteUser']);


//Asistentes
Route::get('/asistentes/select', [AsistentesController::class, 'selectAsistentes']);
Route::post('/asistentes/store', [AsistentesController::class, 'storeAsistentes']);
Route::put('/asistentes/update/{id}', [AsistentesController::class, 'updateAsistentes']);
Route::get('/asistentes/find/{id}', [AsistentesController::class, 'findAsistentes']);
Route::delete('/asistentes/delete/{id}', [AsistentesController::class, 'deleteAsistentes']);

//Categoria de Eventos
Route::get('/categoria/select', [CategoriaEventosController::class, 'selectCategoria']);
Route::post('/categoria/store', [CategoriaEventosController::class, 'storeCategoria']);
Route::put('/categoria/update/{id}', [CategoriaEventosController::class, 'updateCategoria']);
Route::get('/categoria/find/{id}', [CategoriaEventosController::class, 'findCategoria']);
Route::delete('/categoria/delete/{id}', [CategoriaEventosController::class, 'deleteCategoria']);

//Eventos
Route::get('/eventos/select', [EventosController::class, 'selectEventos']);
Route::post('/eventos/store', [EventosController::class, 'storeEventos']);
Route::put('/eventos/update/{id}', [EventosController::class, 'updateEventos']);
Route::get('/eventos/find/{id}', [EventosController::class, 'findEventos']);
Route::get('/eventosasistente/find/{id}', [EventosController::class, 'findEventosAsistentes']);
Route::get('/eventLista/find/{id}', [EventosController::class, 'findLista']);
Route::delete('/eventos/delete/{id}', [EventosController::class, 'deleteEventos']);

//Comentarios
Route::get('/comentarios/select', [ComentariosController::class, 'selectComentarios']);
Route::post('/comentarios/store', [ComentariosController::class, 'storeComentarios']);
Route::put('/comentarios/update/{id}', [ComentariosController::class, 'updateComentarios']);
Route::get('/comentarios/find/{id}', [ComentariosController::class, 'findComentarios']);
Route::delete('/comentarios/delete/{id}', [ComentariosController::class, 'deleteComentarios']);

