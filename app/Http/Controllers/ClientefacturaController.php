<?php

namespace App\Http\Controllers;

use App\Clientefactura;
use Illuminate\Http\Request;
use App\Cliente;
use App\Clienteprod;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;

use App\variable;
use App\Clienteprodben;
use App\Proveedores;

class ClientefacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Cliente $cliente)
    {
        return Clientefactura::where('cliente_id',$cliente->id)->orderBy('id','desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cliente $cliente)
    {
        $factura = new Clientefactura();

        $factura->cliente_id = $cliente->id;
        $factura->numero = time();
        $factura->total = $request->total;
        $factura->descuento = $request->descuento;
        $factura->iva = $request->iva;
        $factura->efectivo = $request->efectivo;
        $factura->deposito = $request->deposito;
        $factura->transferencia = $request->transferencia;
        $factura->tarjeta = $request->tarjeta;
        $factura->cheque = $request->cheque;
        $factura->canje = $request->canje;
        $factura->diferido = $request->diferido;
        $factura->nombre = $request->nombre;
        $factura->apellido = $request->apellido;
        $factura->cedula = $request->cedula;
        $factura->email = $request->email;
        $factura->codigo = time();
        $factura->deposito_num = $request->deposito_num;
        $factura->transferencia_num = $request->transferencia_num;
        $factura->cheque_num = $request->cheque_num;
        $factura->tarjeta_lote = $request->tarjeta_lote;
        $factura->tarjeta_aut = $request->tarjeta_aut;

        $factura->save();

        if ($request->productos) {
            foreach ($request->productos as $row) {
                $cliPro = new Clienteprod();
                
                $cliPro->valor_unitario = $row['valor_unitario'];
                $cliPro->proveedor = $row['proveedor'];
                $cliPro->cantidad = $row['cantidad'];
                $cliPro->producto = $row['producto'];
                $cliPro->utilidad = $row['utilidad'];
                $cliPro->valor_proveedor = $row['valor_proveedor'];
                $cliPro->factura_id = $factura->id;
                $cliPro->valor = $row['valor'];
                $cliPro->correo = $row['correo'];

                
                
                $cliPro->save();
                
                if (@$row['beneficiarios']) {
                    foreach (@$row['beneficiarios'] as $xxx) {
                        $benprod = new Clienteprodben();

                        $benprod->producto_id = $cliPro->id;
                        $benprod->nombre = $xxx['nombre'];
                        $benprod->apellido = $xxx['apellido'];
                        $benprod->cedula = $xxx['cedula'];
                        $benprod->pasaporte = $xxx['pasaporte'];
                        $benprod->fechaNacimiento = $xxx['fechaNacimiento'];
                        $benprod->edad = $xxx['edad'];
                        $benprod->caducidadPasaporte = $xxx['caducidadPasaporte'];

                        $benprod->save();
                    }
                }
            }
        }

        $correos = variable::find(28);

        if ($correos) {
            # code...
            $datos = [
                'factura' => $factura,
            ];
    
            $correosXds = explode(',',$correos->valor);
    
            Mail::send('documentos.email.codigoProducto',$datos,function ($msg) use($correosXds)
            {
                $msg->subject('Codigo de Autorizacion.');
                $msg->to('info@systemsoca.com');
                $msg->cc($correosXds);
            });
        }

        return $factura;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clientefactura  $clientefactura
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente, $clientefactura)
    {
        return Clienteprod::where('factura_id',$clientefactura)->orderBy('id','desc')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clientefactura  $clientefactura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientefactura $clientefactura)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clientefactura  $clientefactura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente,$id)
    {
        $clientefactura = Clientefactura::find($id);

        $clientefactura->delete();
    }

    public function facturaclipro($id)
    {
        $clifac = Clientefactura::find($id);

        $cliente = Cliente::find($clifac->cliente_id);
        $cliPro = Clienteprod::where('factura_id',$clifac->id)->get();

        $datos = [
            'factura'  => $clifac,
            'cliente' => $cliente,
            'productos' => $cliPro,
        ];

        
        $pdf = PDF::loadView('documentos.pdf.clientepro', $datos);
        $pdf->getDomPDF()->set_option("enable_php", true);

        return $pdf->stream('clientepro.pdf');
    }

    public function cambiarEstado(Request $request, $id)
    {
        $factura = Clientefactura::find($id);

        $factura->estado = $request->estado;
        $factura->codigo = time();
        $factura->deposito_num = $request->deposito_num;
        $factura->transferencia_num = $request->transferencia_num;
        $factura->cheque_num = $request->cheque_num;
        $factura->tarjeta_lote = $request->tarjeta_lote;
        $factura->tarjeta_aut = $request->tarjeta_aut;

        if ($request->productos && $request->estado > 2) {
            foreach ($request->productos as $row) {
                $producto = Clienteprod::find($row['id']);

                $producto->cuenta = $row['cuenta'];
                $producto->correo = $row['correo'];
                $producto->valor_proveedor = $row['valor_proveedor'];
                $producto->utilidad = $row['utilidad'];
                $producto->deposito = $row['deposito'];
                @$producto->deposito_directo = $row['deposito_directo'];
                $producto->transferencia = $row['transferencia'];
                @$producto->transferencia_directa = $row['transferencia_directa'];

                $producto->save();
            }
        }

        $factura->save();

        $correos = variable::find(29);
        if ($factura->estado == "3") {
            $correos = variable::find(30);
        }
        if ($factura->estado == "4") {
            $correos = variable::find(31);
        }
        
        if ($factura->estado == "5") {
            $productos = Clienteprod::where('factura_id',$factura->id)->first();
            $proveedor = Proveedores::find($productos->proveedor);

            $datosXD = [
                'proveedor' => $proveedor,
                'datos' => $request
            ];

            Mail::send('documentos.email.proveedor',$datosXD,function ($msg) use($proveedor)
            {
                $msg->subject('One Class Travel.');
                $msg->to($proveedor->correo);
            });
        }

        if ($correos && $factura->estado != "5") {
            # code...
            $datos = [
                'factura' => $factura,
            ];
    
            $correosXds = explode(',',$correos->valor);
    
            Mail::send('documentos.email.codigoProducto',$datos,function ($msg) use($correosXds)
            {
                $msg->subject('Codigo de Autorizacion.');
                $msg->to('info@systemsoca.com');
                $msg->cc($correosXds);
            });
        }

    }
}
