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

    // public function devoluciones(){
    //     $facturas = Factura::all();
    //     return view('todosLosPedidos.index', [
    //         'facturas' => $facturas
    //     ]);

    // }

    // public function crearDevolucion() {

    //     $facturaDevolucion = new FacturaDevolucion();
    //     $facturaDevolucion->cliente_id = $request->input('cliente_id');

    //     $facturaDevolucion->save();


    //     return redirect()->route('devoluciones.index')->with('success', 'Factura de devolución creada correctamente.');

    // }



    public function completados(){

        $query = Factura::query();

        $facturas = $query->paginate(5);
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
