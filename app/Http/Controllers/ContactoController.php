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

    //Envia todos los datos de la tabla contactos a su vista correspondiente
    public function index()
    {
        //Le he puesto un paginador de 5
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

    //Crea un nuevo contacto y te manda a la vista de crearContacto
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
    //Recoge los datos de la vista de crearContacto y los valida, si todo esta correcto se guarda en la tabla contactos y te redirige
    //a la vista del index
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

    //En este caso no hay funcion "edit" porque no utilzo una vista para editar los contactos.
    //Funcion dedicada solo al admin
    //Esta funcion valida la respuesta que el admin ponga en la pregunta que seleccione y si es correcto actualiza
    //la tabla contactos agregando el dato a la tabla nullable "respuesta"
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
    //Funcion dedicada solo al admin
    //Esta funcion le permite borrar una pregunta hecha por un usuario
    public function destroy(Contacto $contacto)
    {

        // Realizar la eliminación del contacto
        $contacto->delete();

        // Redirigir
        return redirect()->back()->with('success', 'Comentario borrado correctamente.');

    }
}
