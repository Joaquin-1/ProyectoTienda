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
    public function index()
    {
        return view('direccion'
        );


    }

    public function contacto()
    {
        return view('contact'
        );


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $direccion->user_id = Auth::user()->id;
        $direccion->save();

        return redirect('/carritos')
            ->with('success', 'Address added successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDireccionRequest  $request
     * @return \Illuminate\Http\Response
     */

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
            ->with('success', 'Address modified successfully');
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
