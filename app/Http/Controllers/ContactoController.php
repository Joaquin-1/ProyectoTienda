<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactoRequest;
use App\Http\Requests\UpdateContactoRequest;
use App\Models\Contacto;
use Illuminate\Support\Facades\Auth;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $contactos = Contacto::all();
        $contactos = Contacto::paginate(5);


        return view('contactos.index', [
            'contactos' => $contactos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contacto = new Contacto();

        return view('contactos.create', [
            'contacto' => $contacto,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactoRequest $request)
    {
        $validados = request()->validate([
            'nombre'=> 'required|string|max:255',
            'email'=> 'required',
            'pregunta'=> 'required',
        ]);

        $contacto = new Contacto();
        $contacto->nombre = $validados['nombre'];
        $contacto->email = $validados['email'];
        $contacto->pregunta = $validados['pregunta'];

        $contacto->user_id = Auth::id();


        $contacto->save();

        return redirect('/contactos')
            ->with('success', 'Pregunta realizada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show(Contacto $contacto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacto $contacto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactoRequest  $request
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

        $validados = request()->validate([
            'respuesta'=> 'required|string',
        ]);

        $contacto = Contacto::findOrFail($id);
        $contacto->respuesta = $validados['respuesta'];

        $contacto->save();

        return redirect('/contactos')
            ->with('success', 'Respuesta enviada con éxito.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacto $contacto)
    {

        // Realizar la eliminación del contacto
        $contacto->delete();

        // Redirigir
        return redirect()->back()->with('success', 'Comentario borrado correctamente.');

    }
}
