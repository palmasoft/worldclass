<?php

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

Route::get('/','PageController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/nuevoinvitado', 'HomeController@crearInvitado');
Route::get('/editarinvitado/{invitado}', 'HomeController@editarInvitado');
Route::get('/configuracion', 'HomeController@configuracion');
Route::get('/invitados/{tipo}/{sede?}', 'HomeController@invitados');
Route::get('/crearcontrato/{invitado?}', 'HomeController@crearContrato');
Route::get('/cargos', 'HomeController@cargos');
Route::get('/empleados', 'HomeController@empleados');
Route::get('/contratos', 'HomeController@contratos');
Route::get('/contratos/{busqueda}', 'HomeController@contratosb');
Route::get('/vercontrato/{contrato}', 'HomeController@contrato');
Route::get('/cartera', 'HomeController@carteras');
Route::get('/cartera/{busqueda}', 'HomeController@carterasb');
Route::get('/vercartera/{contrato}', 'HomeController@cartera');
Route::get('/roles', 'HomeController@roles');
Route::get('/usuarios', 'HomeController@usuarios');
Route::get('/nomina', 'HomeController@nomina');
Route::get('/tmk-opc', 'PageController@tmkNuevo');
Route::get('/reportes', 'HomeController@reportesexcel');
Route::get('/reportesexcel', 'ReportesExcel@reporte');

Route::get('/afiliados/{buscar?}', 'HomeController@afiliados');
Route::get('/tikets-cliente/{cliente}', 'HomeController@tiketsCliente');

Route::get('/productos-cliente/{cliente}','HomeController@productosCliente');

//rutas documentales

Route::get('/pdfcontrato/{contrato}', 'HomeController@pdfcontrato');
Route::get('/pdfpagare1/{contrato}', 'HomeController@pdfpagare1');
Route::get('/pdfpagare2/{contrato}', 'HomeController@pdfpagare2');
Route::get('/pdfsiuso/{contrato}', 'HomeController@pdfsiuso');
Route::get('/pdfsivigencia/{contrato}', 'HomeController@pdfsivigencia');

Route::get('/pdfcertificadovacaciones/{contrato}', 'HomeController@pdfcertificadovacaciones');

Route::get('/pdflegal/{contrato}', 'HomeController@pdflegal');

Route::get('/excelmanifiesto/{sede}', 'DocumentosExcel@manifiesto');
Route::post('/enviamanifiesto/{sede}', 'DocumentosExcel@enviamanifiesto');

Route::post('/embudo', 'DocumentosExcel@embudo');


Route::get('/excelcarteradiaria', 'DocumentosExcel@carteraDiaria');
Route::get('/excelcarteramensual', 'DocumentosExcel@carteraMensual');

//rutas de afiliado

Route::get('/mis-servicios', 'HomeController@misServicios');
Route::get('/mis-tikets', 'HomeController@misTikets');
Route::get('/whatsapp', 'HomeController@whatsapp');
Route::get('/foro-soporte', 'HomeController@foro');



//api rutas

Route::resource('crud/empleados','EmpleadoController');
Route::resource('crud/empleadocargos/{empleado}/','EmpleadoCargoController');

Route::group(['middleware' => ['auth']],function ()
{
    ///afiiado
    Route::resource('crud/tikets/{cliente}/','TiketController');
    Route::delete('crud/tikets/{tiket}','TiketController@destroy');
    Route::get('crud/smstiket/{tiket}','TiketController@getMesages');
    Route::put('crud/tikets/{tiket}','TiketController@update');
    Route::get('crud/tiketestadogestion/{tiket}/{estado}','TiketController@estadoGestion');
    
    Route::post('crud/tiket-archivo/{tiket}','TiketController@subirArchivo');

    Route::resource('crud/foros','ForoController');

    Route::get('crud/contratosbeneficiarios/{contrato}','BeneficiarioController@index');
    Route::post('crud/contratosbeneficiarios/{contrato}','BeneficiarioController@store');
    Route::put('crud/contratosbeneficiarios/{beneficiario}','BeneficiarioController@update');
    Route::delete('crud/contratosbeneficiarios/{beneficiario}','BeneficiarioController@destroy');


    ///////noches jesus diaz///////
    Route::get('crud/contratosnoches/{contrato}','NocheController@index');
    Route::post('crud/contratosnoches/{contrato}','NocheController@store');
    Route::put('crud/contratosnoches/{noche}','NocheController@update');
    Route::delete('crud/contratosnoches/{noche}','NocheController@destroy');

    ///////////////
    Route::post('crud/verificar/{contrato}','ContratoController@verificar');
    Route::post('crud/soporteasignado','ClienteController@soporteasignado');
    
    Route::resource('crud/enunciados','EnunciadoController');

    Route::resource('crud/clienteprods/{cliente}/','ClientefacturaController');
    Route::get('crud/clienteprods/{cliente}/{factura}','ClientefacturaController@show');
    Route::delete('crud/clienteprods/{cliente}/{factura}','ClientefacturaController@destroy');
    Route::put('crud/estadoclifactura/{factura}/','ClientefacturaController@cambiarEstado');
    Route::get('crud/facturaclipro/{clipro}/','ClientefacturaController@facturaclipro');

    
    Route::get('crud/cliprov/{factura}','ClientefacturaController@index');
    Route::post('crud/cliprov/{factura}','ClientefacturaController@store');
    Route::put('crud/cliprov/{cliprov}/','ClientefacturaController@update');

    Route::get('crud/getTmk/{tmk}','EmpleadoController@existeTmk');

    Route::resource('crud/usuarios','UserController');
    Route::resource('crud/roles','RoleController');
    Route::resource('crud/sedes','SedeController');
    Route::resource('crud/clientes','ClienteController');
    Route::get('crud/clientes/{cliente}','ClienteController@show');
    Route::resource('crud/clientetarjetas/{cliente}/','TarjetaController');
    Route::resource('crud/bonos','BonoController');
    Route::resource('crud/servicios','ServicioController');
    Route::resource('crud/tmks/{tipo}/','TmkController');
    Route::resource('crud/cargos','CargoController');
    Route::resource('crud/contratopago/{contrato}/','ContratoPagoController');
    //
    Route::post('crud/contratopago/{contrato}','ContratoPagoController@store');
    Route::delete('crud/contratopago/{pago}','ContratoPagoController@destroy');
    //
    Route::resource('crud/contratocuota/{contrato}/','ContratoCuotaController');
    //
    Route::post('crud/contratocuota/{contrato}','ContratoCuotaController@store');
    //
    Route::resource('crud/contratobono/{contrato}/','ContratoBonoController');
    //
    Route::post('crud/contratobono/{contrato}','ContratoBonoController@store');
    //
    Route::resource('crud/contratoservicio/{contrato}/','ContratoServicioController');
    //
    Route::post('crud/contratoservicio/{contrato}','ContratoServicioController@store');
    //
    Route::resource('crud/contratos','ContratoController');
    Route::resource('crud/variables','VariableController');
    Route::resource('crud/participantes/{cliente}/','ParticipanteController');
    //
    Route::delete('crud/participantes/{cliente}/{participante}','ParticipanteController@destroy');
    
    Route::delete('crud/eliparticipantes/{cliente}','ParticipanteController@eliparticipantes');
    //
    
    Route::resource('crud/productos','ProductoController');
    Route::put('crud/productos/{id}','ProductoController@update');
    Route::resource('crud/proveedores','ProveedoresController');
    Route::put('crud/proveedores/{id}','ProveedoresController@update');

    Route::resource('crud/comentarios/{cliente}/','ComentarioController');
    //
    Route::post('crud/comentarios/{cliente}','ComentarioController@store');
    //
    //Route::resource('crud/comicionables/{contrato}/','ComicionableController');
    //
    Route::post('crud/comicionables/{contrato}/','ComicionableController@store');
    Route::get('crud/comicionables/{contrato}/','ComicionableController@index');
    Route::get('crud/comicionablesem/{empleado}/{busqueda?}','ComicionableController@indexem');


    Route::get('crud/comicionablescontratos/{busqueda?}','ComicionableController@getContratos');


    Route::post('crud/participantes/{cliente}','ParticipanteController@store');


    Route::get('crud/otrosclientes/{tipo}','ClienteController@getClientes');
    Route::put('crud/confirmarclientes/{cliente}','ClienteController@confirmarClientes');
    Route::put('crud/rastrearclientes/{cliente}','ClienteController@rastrearClientes');
    Route::put('crud/calificarclientes/{cliente}','ClienteController@calificarClientes');
    Route::put('crud/reprogramarclientes/{cliente}','ClienteController@reprogramarClientes');
    Route::get('crud/intercambiarParticipantes/{cliente1}/{cliente2}','ClienteController@intercambiarParticipantes');

    Route::post('crud/userroles/{user}','UserController@setRoles');
    Route::get('crud/userroles/{user}','UserController@getRoles');
    Route::get('crud/permisoExiste/{permiso}','UserController@permisoExiste');

    Route::post('crud/permisosrole/{role}','RoleController@setPermisos');
    Route::get('crud/permisosrole/{role}','RoleController@getPermisos');
    Route::get('crud/permisos','RoleController@permisos');

    Route::get('crud/empleadoscargo/{cargo}','EmpleadoController@getEmpleadosCargo');
    Route::get('crud/empleadoscargo2/{cargo}','EmpleadoController@getEmpleadosCargo2');
    Route::get('crud/empleadousuario/{user}','EmpleadoController@empleadousuario');

    Route::get('crud/estadocontratos/{contrato}','ContratoController@estadoContrato');
    Route::get('crud/estadoserviciocontrato/{estado}/{contrato}','ContratoController@estadoServicio');
    Route::get('crud/consecutivocontrato/{consecutivo}/{contrato}','ContratoController@consecutivo'); 
    Route::get('crud/facturacontrato/{factura}/{contrato}','ContratoController@factura');     
    Route::post('crud/legalPdf/{contrato}/{pdf}','ContratoController@legalPdf');    
    Route::get('crud/legalsend/{contrato}','ContratoController@legalsend');        
    Route::get('crud/getlegales/{contrato}','ContratoController@getLegales');      
    Route::get('crud/upcontrato/{contrato}/{tipo}','ContratoController@upContrato');     
    Route::get('crud/replicas/{contrato}','ContratoController@getReplicas');         

    Route::get('crud/paises','PaisController@index');
    Route::get('crud/paises/{pais}','PaisController@estados');
    Route::get('crud/paises/{pais}/{estado}','PaisController@ciudades');

    Route::delete('crud/contratopagoeliminatodo/{contrato}','ContratoPagoController@eliminatodo');
});
//Clear Cache, Routes, Views and Optimize
Route::get('/clear-cache-route-optimize-view','HomeController@limpiarCache');