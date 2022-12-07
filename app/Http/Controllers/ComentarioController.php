<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComentarioRequest;
use App\Http\Requests\UpdateComentarioRequest;
use App\Models\Comentario;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{



    public function anadircomentario()
    {
        $validados = request()->validate([
            'comentario'=> 'required|string|max:300',
            'producto'=> 'required',
        ]);

        $comentario = new Comentario();

        $comentario->producto_id = $validados['producto'];
        $comentario->user_id = Auth::user()->id;
        $comentario->texto = $validados['comentario'];
        $prod = $validados['producto'];
        $comentario->save();

        return redirect('/producto/'.$prod);
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
