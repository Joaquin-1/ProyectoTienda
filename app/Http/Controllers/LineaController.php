<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLineaRequest;
use App\Http\Requests\UpdateLineaRequest;
use App\Models\Linea;

class LineaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreLineaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLineaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Linea  $linea
     * @return \Illuminate\Http\Response
     */
    public function show(Linea $linea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Linea  $linea
     * @return \Illuminate\Http\Response
     */
    //Funcion solo para el admin
    //Esta funcion está en el edit pero realmente es un update, ya que en la vista de todos los pedidos ya esta el input y el
    //boton para cambiar, no utilizo una vista edit.
    //Permite al admin cambiar el estado del pedido(Pendiente de envio, Enviado, Completo)
    public function edit(Linea $linea)
    {
        $validado = request()->validate([
            'estado' => 'required|string',
        ]);
        $linea->estado = $validado['estado'];
        $linea->update();
        return redirect('/todosLosPedidos')->with('success', 'Estado cambiado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLineaRequest  $request
     * @param  \App\Models\Linea  $linea
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLineaRequest $request, Linea $linea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Linea  $linea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Linea $linea)
    {
        //
    }
}
