<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Linea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoAdminController extends Controller
{
    public function index(){
        $facturas = Factura::all();
        return view('todosLosPedidos.index', [
            'facturas' => $facturas
        ]);

    }

    public function completados(){
        $facturas = Factura::all();
        return view('completados', [
            'facturas' => $facturas
        ]);

    }

    public function completadosUser(){
        $facturas = Factura::all()->where('user_id', Auth::user()->id);
        return view('completadosUser', [
            'facturas' => $facturas
        ]);

    }
}
