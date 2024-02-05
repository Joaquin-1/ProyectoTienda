<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDireccionRequest;
use App\Http\Requests\UpdateDireccionRequest;
use App\Models\Direccion;
use Illuminate\Support\Facades\Auth;

class DireccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Se utiliza para poder ver la vista de añadir direccion, realmente sería un "create" porque te lleva a la vista de direccion, que es
    //la que utilizo para que el usuario ponga su direccion.
    public function index()
    {
        return view('direccion'
        );


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Este es el "store" valida por el lado del servidor y lo alamcena en la tabla de direcciones si para la validacion
    public function direccion()
    {
        $validados = request()->validate([
            'calle'=> 'required|string|max:255',
            'ciudad'=> 'required',
            'codigo_postal'=> 'required',
            'pais'=> 'required',
        ]);

        $direccion = new Direccion();
        $direccion->calle = $validados['calle'];
        $direccion->ciudad = $validados['ciudad'];
        $direccion->codigo_postal = $validados['codigo_postal'];
        $direccion->pais = $validados['pais'];
        //Se le asigna esa direccion al usuario logueado
        $direccion->user_id = Auth::user()->id;
        $direccion->save();

        return redirect('/carritos')
            ->with('success', 'Direccion agregada correctamente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDireccionRequest  $request
     * @return \Illuminate\Http\Response
     */

//Funcion "update", valida los datos nuevos y te redirige a carrito si todo es correcto
    public function setDireccion()
    {
        $validados = request()->validate([
            'calle'=> 'required|string|max:255',
            'ciudad'=> 'required',
            'codigo_postal'=> 'required',
            'pais'=> 'required',
        ]);

        $direccion = Direccion::where('user_id', Auth::user()->id)->first();
        $direccion->calle = $validados['calle'];
        $direccion->ciudad = $validados['ciudad'];
        $direccion->codigo_postal = $validados['codigo_postal'];
        $direccion->pais = $validados['pais'];
        $direccion->user_id = Auth::user()->id;
        $direccion->save();

        return redirect('/carritos')
            ->with('success', 'Direccion modificada correctamente');
    }
    public function store(StoreDireccionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function show(Direccion $direccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */

     //Te lleva a la vista de setDireccion y le envia los datos de direccino del usuario logueado
    public function edit(Direccion $direccion)
    {
        $direccion = Direccion::all()->where('user_id', Auth::user()->id);
        return view('setDireccion', [
            'direccion' => $direccion
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDireccionRequest  $request
     * @param  \App\Models\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDireccionRequest $request, Direccion $direccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Direccion $direccion)
    {
        //
    }
}
