<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function __invoke(Request $request)
    {                                                             //1          2        3
        
        $clientes   =   Cliente::all();
        
        return view('welcome', compact('clientes'));
    }
}
