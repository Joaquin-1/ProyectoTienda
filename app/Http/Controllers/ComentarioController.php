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
    //Valida el comentario por el lado del servidor
    $validados = request()->validate([
        'comentario' => 'required|string|max:300',
        'producto' => 'required',
    ]);

    //Crea un comentario nuevo con el id del usuario logueado, el id del producto al que se le ha puesto el comentario y el contenido del comentario
    $comentario = new Comentario();
    $comentario->producto_id = $validados['producto'];
    $comentario->user_id = Auth::user()->id;
    $comentario->texto = $validados['comentario'];
    $comentario->save();

    //El comentario se agrega de forma asincrona a la pagina mediante ajax (odio ajax)
    $nombreUsuario = Auth::user()->name;

    return response()->json([
        'success' => true,
        'message' => 'Comentario agregado correctamente',
        'comentario' => [
            'id' => $comentario->id,
            'texto' => $comentario->texto,
            'producto_id' => $comentario->producto_id,
            'user_id' => $comentario->user_id,
            'nombre_usuario' => $nombreUsuario,
            'created_at' => $comentario->created_at,
            'updated_at' => $comentario->updated_at,
        ],
    ]);
}



    //Esta función es muy parecida a la anterior solo cambia el valor comentario_id (nullable), en este caso si el comentario va a ser una
    //respuesta recogera el id del comentario principal, por lo demas es igual
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

        //Al comentar te redirige a la vista del producto en el que has comentado, no hay ajax.
        return redirect('/producto/'.$prod);
    }

    //Te permite borrar un comentario, esta función esta dedicada solo al admin
    public function destroy($id)
    {
        $comentario = Comentario::findOrFail($id);
        $comentario->delete();

        return redirect()->back()
            ->with('success', 'Comentario borrado correctamente');
    }

}
