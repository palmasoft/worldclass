<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clienteproveedor;
use App\Clientefactura;

class ClienteproveedorController extends Controller
{
    public function index(Clientefactura $factura)
    {
        return Clienteproveedor::where('factura_id',$factura->id)->get();
    }

    public function store(Request $request,Clientefactura $factura)
    {
        $provcli = new Clienteproveedor();

        $provcli->factura_id = $factura->id;
        $provcli->cantidad = $request->cantidad;
        $provcli->valor_cobrado = $request->valor_cobrado;
        $provcli->valor_proveedor = $request->valor_proveedor;
        $provcli->utilidad = $request->utilidad;
        $provcli->producto = $request->producto;
        $provcli->proveedor = $request->proveedor;
        $provcli->cuenta = $request->cuenta;
        $provcli->correo = $request->correo;
        $provcli->transferencia = $request->transferencia;
        $provcli->transferencia_directa = $request->transferencia_directa;
        $provcli->deposito = $request->deposito;
        $provcli->deposito_directos = $request->deposito_directos;

        $provcli->save();
        

        return $provcli;
    }

    public function update(Request $request, Clienteproveedor $provcli)
    {
        $provcli->cantidad = $request->cantidad;
        $provcli->valor_cobrado = $request->valor_cobrado;
        $provcli->valor_proveedor = $request->valor_proveedor;
        $provcli->utilidad = $request->utilidad;
        $provcli->producto = $request->producto;
        $provcli->proveedor = $request->proveedor;
        $provcli->cuenta = $request->cuenta;
        $provcli->correo = $request->correo;
        $provcli->transferencia = $request->transferencia;
        $provcli->transferencia_directa = $request->transferencia_directa;
        $provcli->deposito = $request->deposito;
        $provcli->deposito_directos = $request->deposito_directos;

        $provcli->save();
        

        return $provcli;
    }
}
