<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Carbon\Carbon;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {                                                             //1          2        3
        $filtroOrderBy = in_array($request->get('order_by'), ['nombre', 'apellido', 'email']) ? $request->get('order_by') : 'nombre';
        $filtroOrderASC = in_array($request->get('asc'), ['asc', 'desc']) ? $request->get('asc') : 'asc';
        $filtroElementoPorPagina = $request->per_page??15;

        $clientes   =   Cliente::orderBy($filtroOrderBy, $filtroOrderASC)->simplePaginate($filtroElementoPorPagina);
        return $clientes;
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente();

        $cliente->nombre = $request->nombre;
        $cliente->apellidos = $request->apellidos;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->direccion = $request->direccion;
        
        if ($request->hasFile('foto')){
            $nombreArchivo = $request->file('foto')->getClientOriginalName();
            $nuevoNombre = Carbon::now()->timestamp."_".$nombreArchivo;
            $carpetaDestino = './upload/';
            $request->file('foto')->move($carpetaDestino, $nuevoNombre);

            $cliente->foto = ltrim($carpetaDestino, '.').$nuevoNombre;
        }
        

        $cliente->save();

        return $cliente;
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);

        return $cliente;
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        if ($request->input('nombre'))
            $cliente->nombre = $request->nombre;
        if ($request->input('apellidos'))
            $cliente->apellidos = $request->apellidos;
        if ($request->input('telefono'))
            $cliente->telefono = $request->telefono;
        if ($request->input('email'))
            $cliente->email = $request->email;
        if ($request->input('direccion'))
            $cliente->direccion = $request->direccion;
        
        
        if ($request->hasFile('foto')){
            $nombreArchivo = $request->file('foto')->getClientOriginalName();
            $nuevoNombre = Carbon::now()->timestamp."_".$nombreArchivo;
            $carpetaDestino = './upload/';
            $request->file('foto')->move($carpetaDestino, $nuevoNombre);
            $rutaImagen = base_path('public') . $cliente->foto;
            unlink($rutaImagen);
            $cliente->foto = ltrim($carpetaDestino, '.').$nuevoNombre;
        }
        

       $cliente->save();

        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        
        $rutaImagen = base_path('public') . $cliente->foto;
        if (file_exists($rutaImagen))
            unlink($rutaImagen);
        
        $cliente->delete();

        if ($request->input('from_gui'))
            return redirect()->route('index');
        else
            return $cliente;
    }
}
