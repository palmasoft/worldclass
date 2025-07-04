<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedores;

class ProveedoresController extends Controller
{
    public function index()
    {
        return Proveedores::get();
    }

    public function store(Request $request)
    {
        $proveedor = new Proveedores();

        $proveedor->nombre = $request->nombre;
        $proveedor->correo = $request->correo;
        $proveedor->banco = $request->banco;
        $proveedor->cuenta_numero = $request->cuenta_numero;
        $proveedor->cuenta_tipo = $request->cuenta_tipo;
        $proveedor->porcentaje = $request->porcentaje;

        
        $proveedor->banco2 = $request->banco2;
        $proveedor->cuenta_numero2 = $request->cuenta_numero2;
        $proveedor->cuenta_tipo2 = $request->cuenta_tipo2;
        
        $proveedor->banco3 = $request->banco3;
        $proveedor->cuenta_numero3 = $request->cuenta_numero3;
        $proveedor->cuenta_tipo3 = $request->cuenta_tipo3;

        
        $proveedor->banco4 = $request->banco4;
        $proveedor->cuenta_numero4 = $request->cuenta_numero4;
        $proveedor->cuenta_tipo4 = $request->cuenta_tipo4;

        $proveedor->save();

        return $proveedor;
    }

    public function show(Proveedores $proveedor)
    {
        return $proveedor;
    }

    public function update(Request $request, $id)
    {
        $proveedor = Proveedores::find($id);

        $proveedor->nombre = $request->nombre;
        $proveedor->correo = $request->correo;
        $proveedor->banco = $request->banco;
        $proveedor->cuenta_numero = $request->cuenta_numero;
        $proveedor->cuenta_tipo = $request->cuenta_tipo;
        $proveedor->porcentaje = $request->porcentaje;

        
        $proveedor->banco2 = $request->banco2;
        $proveedor->cuenta_numero2 = $request->cuenta_numero2;
        $proveedor->cuenta_tipo2 = $request->cuenta_tipo2;
        
        $proveedor->banco3 = $request->banco3;
        $proveedor->cuenta_numero3 = $request->cuenta_numero3;
        $proveedor->cuenta_tipo3 = $request->cuenta_tipo3;

        
        $proveedor->banco4 = $request->banco4;
        $proveedor->cuenta_numero4 = $request->cuenta_numero4;
        $proveedor->cuenta_tipo4 = $request->cuenta_tipo4;

        $proveedor->save();

        return $proveedor;
    }

    public function destroy($id)
    {
        $proveedor = Proveedores::find($id);

        $proveedor->delete();
    }
}
