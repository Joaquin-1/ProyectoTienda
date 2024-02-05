<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFuturaspeliculasRequest;
use App\Http\Requests\UpdateFuturaspeliculasRequest;
use App\Models\Futuraspeliculas;

class FuturaspeliculasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Ultimo controlador agregado al proyecto, esto permite pasar los datos de la tabla "futuraspeliculas" a la vista de inicio
    public function index()
    {
        $futuraspeliculas = Futuraspeliculas::all();


        return view('welcome1', ['futuraspeliculas' => $futuraspeliculas]);
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
     * @param  \App\Http\Requests\StoreFuturaspeliculasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFuturaspeliculasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Futuraspeliculas  $futuraspeliculas
     * @return \Illuminate\Http\Response
     */
    public function show(Futuraspeliculas $futuraspeliculas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Futuraspeliculas  $futuraspeliculas
     * @return \Illuminate\Http\Response
     */
    //Funcion dedicada al admin
    //Te lleva a la vista de editarFuturaPelicula recogiendo los datos de la pelicula vinculada al boton pulsado
    public function edit($id)
    {
        $futuraspeliculas = Futuraspeliculas::findOrFail($id);

        return view('futuraspeliculas.edit', [
            'futuraspeliculas' => $futuraspeliculas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFuturaspeliculasRequest  $request
     * @param  \App\Models\Futuraspeliculas  $futuraspeliculas
     * @return \Illuminate\Http\Response
     */
    //Funcion dedicada al admin
    //Valida los datos cambiado en la vista del edit y si todo esta correcto actualiza los datos de la tabla
    public function update($id)
    {
        $validados = request()->validate([
            'nombre'=> 'required',
            'imagen_url' => 'required',
        ]);

        $futuraspeliculas = Futuraspeliculas::findOrFail($id);
        //Columnas de la tabla futurasPeliculas
        $futuraspeliculas->nombre = $validados['nombre'];
        $futuraspeliculas->imagen_url = "img/" . $validados['imagen_url']->getClientOriginalName();

        //Guardamos cambios
        $futuraspeliculas->save();

        //Te redirige a la vista en la que el admin puede interactuar con los datos de la tabla
        return redirect('/perfiles')
            ->with('success', 'Peliculas modificadas con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Futuraspeliculas  $futuraspeliculas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Futuraspeliculas $futuraspeliculas)
    {
        //
    }
}
