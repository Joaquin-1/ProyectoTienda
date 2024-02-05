<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Linea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoAdminController extends Controller
{
    //Funcion dedicada al admin
    //Muestra la vista de todos los pedidos de todos los usuarios
    public function index(){
        $facturas = Factura::all();
        return view('todosLosPedidos.index', [
            'facturas' => $facturas
        ]);

    }


    //Funcion dedicada al admin
    //Muestra todos los pedidos que ya se han completados, ahora como factura puedes ver un historial de compra general de todos los usuarios
    public function completados(){

        //He paginado los datos mostrados para que el admin no tenga una lista general de todo en una sola vista, ademas facilita la carga a la
        //aplicacion
        $query = Factura::query();

        $facturas = $query->paginate(5);
        return view('completados', [
            'facturas' => $facturas
        ]);

    }

    //Funcion dedicada al Usuario(aunque el admin tambien puede acceder)
    //Esta funcion muestra un historial/factura de todos los pedidos personales de cada usuario
    public function completadosUser(){
        $facturas = Factura::all()->where('user_id', Auth::user()->id);


        return view('completadosUser', [
            'facturas' => $facturas
        ]);

    }
}
