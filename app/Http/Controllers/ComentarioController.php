<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComentarioRequest;
use App\Http\Requests\UpdateComentarioRequest;
use App\Models\Comentario;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{



    public function anadircomentario(Request $request)
{
    $validados = request()->validate([
        'comentario' => 'required|string|max:300',
        'producto' => 'required',
    ]);

    $comentario = new Comentario();
    $comentario->producto_id = $validados['producto'];
    $comentario->user_id = Auth::user()->id;
    $comentario->texto = $validados['comentario'];
    $comentario->save();


    $nombreUsuario = Auth::user()->name;

    return response()->json([
        'success' => true,
        'message' => 'Comentario agregado correctamente',
        'comentario' => [
            'id' => $comentario->id,
            'texto' => $comentario->texto,
            'producto_id' => $comentario->producto_id,
            'user_id' => $comentario->user_id,
            'nombre_usuario' => $nombreUsuario, // Agrega el nombre del usuario aquí
            'created_at' => $comentario->created_at,
            'updated_at' => $comentario->updated_at,
        ],
    ]);
}




    public function anadirrespuesta()
    {
        $validados = request()->validate([
            'comentario'=> 'required|string|max:300',
            'producto'=> 'required',
            'comentariopadre'=> 'required',
        ]);

        $comentario = new Comentario();

        $comentario->producto_id = $validados['producto'];
        $comentario->user_id = Auth::user()->id;
        $comentario->texto = $validados['comentario'];
        $comentario->comentario_id = $validados['comentariopadre'];
        $prod = $validados['producto'];
        $comentario->save();

        return redirect('/producto/'.$prod);
    }

}
