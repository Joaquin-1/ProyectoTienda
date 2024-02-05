<?php
namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Factura;
use App\Models\Linea;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;
class StripeController extends Controller
{
    /**
     * payment view
     */

    //Este controlador lo generas cuando instalas la API "Stripe".

    //Esto te maneja la vista a los detalles de pago de un producto, coge los datos del carrito del usuario logueado para
    //saber cuanto dinero se gasta.
    //Nota: El controlador, la vista y todos los datos relacionados con el Stripe son un copia y pega de la pagina oficial de
    //Stripe junto a un videotutorial.
    public function handleGet($total)
    {
        $carritos = Carrito::all();
        return view('home', [
            'total' => $total,
            'carritos' => $carritos->where('user_id', Auth::user()->id),
        ]);
    }

    /**
     * handling payment with POST
     */

    //Esta función hace todos los requerimentos para que se ejecute el pago correctamente con los datos proporcionados
    public function handlePost(Request $request)
    {
        $total = 0;
        //Recoge las filas del carrito del usuario logueado
        for ($i=0; $i < Carrito::where('user_id', Auth::user()->id)->count(); $i++) {
        //Las va agregando a la variable "total"
        $total += Carrito::where('user_id', Auth::user()->id)->get()[$i]->producto->precio * Carrito::where('user_id', Auth::user()->id)->get()[$i]->cantidad;
        }

        //Pilla el codigo "STRIPE SECRET" y el stripeToken, esta en el .env
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * $total,
                "currency" => "eur",
                "source" => $request->stripeToken,
                "description" => "Making test payment."
        ]);

        //Una vez hecho el pago se genera una factura
        $nuevafactura = new Factura();

        //Con el user_id del usuario que hizo el pago
        $nuevafactura->user_id = auth()->user()->id;
        $nuevafactura->save();

        $carrito = Carrito::where('user_id', auth()->user()->id)->get();
        //Con los datos del carrito se crea un foreach que recorra el carrito y vaya recogiendo los datos para
        //la tabla "lineas", una vez que se agregan los datos el carrito se borra.
        foreach ($carrito as $lineacarrito) {
            $nuevalinea = new Linea();
            $nuevalinea->factura_id = $nuevafactura->id;
            $nuevalinea->producto_id = $lineacarrito->producto_id;
            $nuevalinea->cantidad = $lineacarrito->cantidad;
            $nuevalinea->save();
        }

        $carrito->each->delete();

        return redirect()->route('carritos.index')->with('success', 'Pedido realizado con exito.');
    }
}
