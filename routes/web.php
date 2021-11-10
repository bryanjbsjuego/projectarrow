<?php

use Illuminate\Support\Facades\Route;
//Controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\AfianzadoraController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\OperativoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UnidadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function (){

    Route::resource('roles',RolController::class);
    Route::resource('usuarios',UsuarioController::class);
    Route::resource('empresas',EmpresaController::class);
    Route::resource('afianzadoras',AfianzadoraController::class);
    Route::resource('clientes',ClienteController::class);
    Route::resource('empleados',EmpleadoController::class);
    Route::get('empleados/{empleado}/activar',[EmpleadoController::class,'activar'])->name('empleados.activar');
    Route::resource('perfil',PerfilController::class);
    Route::resource('cargos',CargoController::class);
    Route::resource('operativos',OperativoController::class);
    Route::resource('unidades',UnidadController::class);
    Route::get('eliminadas',[UnidadController::class,'eliminadas'])->name('unidades.baja');
    Route::get('unidades/{id}/activar',[UnidadController::class,'activar'])->name('unidades.activas');


} );




Route::resource('tenant', TenantController::class);
