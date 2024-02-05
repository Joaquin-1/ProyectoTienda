<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarritoRequest;
use App\Http\Requests\UpdateCarritoRequest;
use App\Models\Carrito;
use App\Models\Factura;
use App\Models\Linea;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Te muestra todo los carritos que pertenezcan al usuario logueado (solo tiene un carrito)
    public function index()
    {
        $carritos = Carrito::all();

        return view('carritos.index', [
            'carritos' => $carritos->where('user_id', Auth::user()->id)->sortBy('producto.nombre')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarritoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarritoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function show(Carrito $carrito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function edit(Carrito $carrito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarritoRequest  $request
     * @param  \App\Models\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarritoRequest $request, Carrito $carrito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carrito $carrito)
    {
        //
    }

    //Esto permite añadir al carrito los productos
    public function anadiralcarrito(Producto $producto)
    {
        //Te busca un carro con el id del usuario logueado y el id del producto que has intentado agregar
        $carrito = Carrito::where('producto_id', $producto->id)->where('user_id', auth()->user()->id)->first();

        //Si el carrito con esas caracteristicas no existe todavia crea uno nuevo con los datos del usuario y el producto seleccionado
        //y te redirige de nuevo a la vista de productos
        if (empty($carrito)) {

            $carrito = new Carrito();

            $carrito->user_id = Auth::user()->id;
            $carrito->producto_id = $producto->id;
            $carrito->cantidad = 1;

            $carrito->save();

            return redirect()->route('productos')->with('success', 'Producto añadido al carrito.');
        }

        //Si ya hay un carrito con el id del usuario y el id del producto solo te agrega un producto igual al que ya esta
        $carrito->cantidad += 1;
        $carrito->save();

        return redirect()->route('productos')->with('success', 'Producto anadido al carrito.');
    }

    //Te permite restar cantidad de un producto que ya esta en el carrito
    public function restar(Carrito $carrito)
    {
        //Borra el carrito si la cantidad de ese producto es 1 y solo existe ese producto en el carrito
        if ($carrito->cantidad === 1) {
            $carrito->delete();


            return redirect()->route('carritos.index')->with('success', 'Producto borrado del carrito.');
        }

        //Si quitas un producto y no es el unico que está en el carrito solo se baja la cantidad de productos pero se conserva el carrito
        //con el resto de cosas
        $carrito->cantidad -= 1;
        $carrito->save();

        return redirect()->route('carritos.index')->with('success', 'Producto restado al carrito.');
    }

    //Lo mismo que restar pero mas fácil, solo se suma 1 a la cantidad del producto que ya exista.
    public function sumar(Carrito $carrito)
    {
        $carrito->cantidad += 1;
        $carrito->save();

        return redirect()->route('carritos.index')->with('success', 'Producto sumado al carrito.');
    }


    //Borra el carrito del usuario que está logueado y te redirige a la vista del carrito
    public function vaciar()
    {
        $carrito = Carrito::where('user_id', auth()->user()->id);
        $carrito->delete();

        return redirect()->route('carritos.index')->with('success', 'Carrito vaciado con exito.');
    }

    //Esta función te crea un linea en la tabla factura, esta tendrá el userID del usuario logueado
    //Nota: Esta funcion sale sombreada porque no se usa, esta función era la que usaba antes de tener el
    //pago con tarjeta. Para ver la funcion que se usa actualmente ve a StripeController (HandlePost)
    public function pedido(Linea $linea, Factura $factura)
    {
        $nuevafactura = new Factura();

        $nuevafactura->user_id = auth()->user()->id;
        $nuevafactura->save();

        //Seleccionas el carrito del usuario logueado
        $carrito = Carrito::where('user_id', auth()->user()->id)->get();
        //Recorre los datos del carrito, por cada dato del carrito crea una linea (lineadefactura)
        foreach ($carrito as $lineacarrito) {
            $nuevalinea = new Linea();
            //Con la nueva linea creada coge el id de la factura creada arriba (esta ya tiene el id del usuario)
            $nuevalinea->factura_id = $nuevafactura->id;
            //Coge el id del producto del carrito
            $nuevalinea->producto_id = $lineacarrito->producto_id;
            //Coge la cantidad de el producto que ya estaba guardado en el carrito
            $nuevalinea->cantidad = $lineacarrito->cantidad;
            $nuevalinea->save();
        }
        //Una vez que recoge los datos del carrito, este se borra
        $carrito->each->delete();

        return redirect()->route('carritos.index')->with('success', 'Pedido realizado con exito.');
    }
}
