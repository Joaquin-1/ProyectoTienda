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
    public function handlePost(Request $request)
    {
        $total = 0;
        for ($i=0; $i < Carrito::where('user_id', Auth::user()->id)->count(); $i++) {

        $total += Carrito::where('user_id', Auth::user()->id)->get()[$i]->producto->precio * Carrito::where('user_id', Auth::user()->id)->get()[$i]->cantidad;
        }

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * $total,
                "currency" => "eur",
                "source" => $request->stripeToken,
                "description" => "Making test payment."
        ]);

        $nuevafactura = new Factura();

        $nuevafactura->user_id = auth()->user()->id;
        $nuevafactura->save();

        $carrito = Carrito::where('user_id', auth()->user()->id)->get();

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
