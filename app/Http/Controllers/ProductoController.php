<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('has.permission:producto.store')->only('store');
        $this->middleware('has.permission:producto.update')->only('update');
        $this->middleware('has.permission:producto.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Producto::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Producto();

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->valor = $request->valor;
        $producto->proveedor_id = $request->proveedor_id;
        $producto->proveedor_id2 = $request->proveedor_id2;
        $producto->proveedor_id3 = $request->proveedor_id3;
        $producto->proveedor_id4 = $request->proveedor_id4;
        $producto->proveedor_id5 = $request->proveedor_id5;
        $producto->porcentaje = $request->porcentaje;

        $producto->save();

        return $producto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return $producto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->valor = $request->valor;
        $producto->proveedor_id = $request->proveedor_id;
        $producto->proveedor_id2 = $request->proveedor_id2;
        $producto->proveedor_id3 = $request->proveedor_id3;
        $producto->proveedor_id4 = $request->proveedor_id4;
        $producto->proveedor_id5 = $request->proveedor_id5;
        $producto->porcentaje = $request->porcentaje;

        $producto->save();

        return $producto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
    }
}
