<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Imagen;


class UserController extends Controller
{
    public function index(){
        $users = User::all()->where('id', Auth::user()->id)->first();
        $imagenes = Imagen::all();
        return view('perfiles.index', [
            'users' => $users,
            'imagenes' => $imagenes,
        ]);

    }




    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('perfiles.edit', [
            'user' => $user,
        ]);
    }

    public function update($id)
    {

        $validados = request()->validate([
            'name'=> 'required|string|max:25',
            'descripcion'=> 'nullable|string|min:20',
            'imagen' => 'required',
            'telefono' => 'nullable|string|max:9',
            'ciudad' => 'nullable|string|max:255',
            'pais' => 'nullable|string|max:255',

        ]);

        $user = User::findOrFail($id);
        $user->name = $validados['name'];
        $user->descripcion = $validados['descripcion'];
        $user->imagen = "img/" . $validados['imagen']->getClientOriginalName();
        $user->telefono = $validados['telefono'];
        $user->ciudad = $validados['ciudad'];
        $user->pais = $validados['pais'];


        $user->save();

        return redirect('/perfiles')
            ->with('success', 'Perfil modificado con éxito.');
    }

}

