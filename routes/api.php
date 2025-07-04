<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*
Route::apiResource('usuarios','UserController');
Route::apiResource('roles','RoleController');
Route::apiResource('sedes','SedeController');
Route::apiResource('clientes','ClienteController');
Route::apiResource('bonos','BonoController');
Route::apiResource('servicios','ServicioController');
Route::apiResource('tmks/{tipo}/','TmkController');
Route::apiResource('empleados','EmpleadoController');
Route::apiResource('cargos','CargoController');
Route::apiResource('empleadocargos/{empleado}/','EmpleadoCargo');
Route::apiResource('contratopago/{contrato}/','ContratoPagoController');
Route::apiResource('contratocuota/{contrato}/','ContratoCuotaController');
Route::apiResource('contratobono/{contrato}/','ContratoBonoController');
Route::apiResource('contratoservicio/{contrato}/','ContratoServicioController');
Route::apiResource('contratos','ContratoController');
Route::apiResource('variables','VariableController');
Route::apiResource('participantes','ParticipanteController');
//Route::apiResource('comicionables','ComicionableController');



Route::get('otrosclientes/{tipo}','ClienteController@getClientes');

Route::post('userroles/{user}','UserController@setRoles');
Route::get('userroles/{user}','UserController@getRoles');

Route::post('permisosrole/{role}','RoleController@setPermisos');
Route::get('permisosrole/{role}','RoleController@getPermisos');
Route::get('permisos','RoleController@permisos');

Route::get('empleadoscargo/{cargo}','EmpleadoController@getEmpleadosCargo');

Route::get('estadocontratos/{contrato}','ContratoController@estadoContrato');
Route::get('estadoserviciocontrato/{estado}/{contrato}','ContratoController@estadoServicio');
*/