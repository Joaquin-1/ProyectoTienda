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
            'name'=> 'required|string|max:255',
            'descripcion'=> 'required',
            /*'precio'=> 'required',
            'video'=> 'required', */
        ]);

        $user = User::findOrFail($id);
        $user->name = $validados['name'];
        $user->descripcion = $validados['descripcion'];
        /*$producto->precio = $validados['precio'];
        $producto->video = $validados['video']; */

        $user->save();

        return redirect('/perfiles')
            ->with('success', 'Perfil modificado con éxito.');
    }

}

