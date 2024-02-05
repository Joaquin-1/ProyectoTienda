<?php

namespace App\Http\Controllers;

use App\Models\Futuraspeliculas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Imagen;


class UserController extends Controller
{
    //Muestra los datos del usuario logueado en su perfil
    public function index(){
        $users = User::all()->where('id', Auth::user()->id)->first();
        $imagenes = Imagen::all();

        //Variable dedicada al admin, esta permite ver los datos de futurasPeliculas y editarlos
        //para la vista inicial/welcome de la aplicacion
        $futuraspeliculas = Futuraspeliculas::all();


        return view('perfiles.index', [
            'users' => $users,
            'imagenes' => $imagenes,
            'futuraspeliculas' => $futuraspeliculas,

        ]);

    }



    //Un edit basico
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('perfiles.edit', [
            'user' => $user,
        ]);
    }

    //Actualiza los datos si estan correctos
    public function update($id)
    {
        //Validacion
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

    //Funcion dedicada al admin
    //Le permite ver a todos los usuarios
    public function verClientes()
    {
        $admin = Auth::user();
        //Lo he paginado para que no aparezcan todos en una sola vista
        $clientes = User::where('rol', 'cliente')->paginate(10);

        return view('usuarios.ver-clientes', compact('admin', 'clientes'));

    }

    //Funcion dedicada al admin
    //Otra funcion problemática, permite al admin borrar a un usuario por completo junto a todos los datos que tenga en la aplicacion
    //¿Es ilegal almacenar datos de usuario borrados?
    public function destroy($id)
    {
        $cliente = User::findOrFail($id);
        $cliente->delete();

        return redirect()->back()
            ->with('success', 'Producto borrado correctamente');
    }

}

