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
    public function index()
    {
        $futuraspeliculas = Futuraspeliculas::all();

        return view('welcome1', [
            'futuraspeliculas' => $futuraspeliculas,
        ]);
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
    public function edit(Futuraspeliculas $futuraspeliculas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFuturaspeliculasRequest  $request
     * @param  \App\Models\Futuraspeliculas  $futuraspeliculas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFuturaspeliculasRequest $request, Futuraspeliculas $futuraspeliculas)
    {
        //
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
