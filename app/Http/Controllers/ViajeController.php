<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use Illuminate\Http\Request;

class ViajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viajes   =   Viaje::all();
        return $viajes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
            public function store(Request $request)
        {
            $cliente = new Cliente();

            $cliente->nombre = $request->nombre;
            $cliente->apellidos = $request->apellidos;
            $cliente->teléfono = $request->teléfono;
            $cliente->email = $request->email;
            $cliente->dirección = $request->dirección;
            $cliente->foto = $request->foto;

            $cliente->save();
        }*/

        $xmlString = $request->getContent();
        $xmlObject = simplexml_load_string($xmlString);
                   
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);

        foreach ($phpArray['viaje'] as $viaje){
            $nuevo_viaje = new Viaje();

   

            $nuevo_viaje->email = $viaje['email'];
            $nuevo_viaje->fecha = $viaje['fecha'];
            $nuevo_viaje->pais = $viaje['pais'];
            $nuevo_viaje->ciudad = $viaje['ciudad'];


            $nuevo_viaje->save();    
        }

        return $phpArray['viaje'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
