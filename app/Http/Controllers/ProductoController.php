<?php

namespace App\Http\Controllers;



use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Categoria;
use App\Models\Imagen;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Vista general de todos los productos, la vista principal de la web
    public function index()
    {

        //No se llama a los productos porque ya se hace en el controlador del livewire (/livewire/FiltradoProductos)

        return view('productos.index', [
        ]);

    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Funcion dedicada al admin
    //Permitecrear un producto nuevo
    public function create()
    {
        $producto = new Producto();
        //Recojo las categoria,
        $categorias = Categoria::all();

        //En la vista de crear productos envio tambien las categorias para poder asignarle una categoria a la pelicula a crear.
        return view('productos.create', [
            'producto' => $producto,
            'categorias' => $categorias,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreZapatoRequest  $request
     * @return \Illuminate\Http\Response
     */
    //Funcion dedicada al admin
    //Funcion que guarda una peli nueva en la tabla productos
    public function store(StoreProductoRequest $request)
    {
        //Validacion
        $validados = request()->validate([
            'nombre'=> 'required|max:255',
            'descripcion'=> 'required',
            'precio'=> 'required',
            'video'=> 'required',
            'categoria_id'=> 'required|exists:categorias,id',
        ]);

        $producto = new Producto();
        $imagen = new Imagen();

        $producto->nombre = $validados['nombre'];
        $image = $request->file('imagen');
            // Movemos a la carpeta deseada
            $image->move(public_path('img'), $image->getClientOriginalName());

            // Lo guardamos en la base de datos como string para que el admin no tenga que poner comillas ni la ruta
            $imagen->imagen = "img/" . $image->getClientOriginalName();

        $producto->descripcion = $validados['descripcion'];
        $producto->precio = $validados['precio'];
        $producto->video = $validados['video'];
        $producto->categoria_id = $validados['categoria_id'];


        $producto->save();
        //Le agregas el producto_id del producto guardado a la imagen en su tabla correspondiente para vincularla al producto
        $imagen->producto_id = Producto::whereRaw('id = (select max(id) from productos)')->get()[0]->id;
        $imagen->save();

        return redirect('/productos')
            ->with('success', 'Producto insertado con éxito.');


    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    //Funcion dedicada al admin
    //Esta función te manda el producto con el id relacionado al boton pulsado y te manda a la vista de editProducto
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

        return view('productos.edit', [
            'producto' => $producto,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductoRequest  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    //Funcion dedicada al admin
    //Función que actualiza los datos de una pelicula
    public function update($id)
    {
        //Valido los datos
        $validados = request()->validate([
            'nombre'=> 'required|string|max:255',
            'descripcion'=> 'required',
            'precio'=> 'required',
            'video'=> 'required',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->nombre = $validados['nombre'];
        $producto->descripcion = $validados['descripcion'];
        $producto->precio = $validados['precio'];
        $producto->video = $validados['video'];

        $producto->save();

        return redirect('/productos')
            ->with('success', 'Producto modificado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    //Funcion dedicada al admin
    //Esta funcion te manda a la vista de agregar imagen (Es para el carrusel que tiene cada producto cuando entras en los detalles)
    public function setImagen($id)
    {
        $producto = Producto::findOrFail($id);

        return view('productos.anadirImagen', [
            'producto' => $producto,
        ]);
    }

    //Funcion dedicada al admin
    //Esta funcion crea un nuevo dato "imagen" en su tabla y ahora vincula su columna "producto_id" con el id
    //del producto que has seleccionado. Esto permite que cada producto tenga mas de una imagen agregada.
    public function postImagen($id){

        //Validamos el nombre del archivo.
        $validados = request()->validate([
            'imagen'=> 'required|mimes:png,jpg,jpeg',
        ]);

        $validados['imagen']->move(public_path('img'), $validados['imagen']->getClientOriginalName());

        //Es como un store común pero cambiando que este dato se vincula al producto con el producto_id
        $imagen = New Imagen();
        //Es un poco lioso porque la tabla se llama "imagens" y la columna que almacena la ruta de
        //las imagenes se llama "imagen" en vez de "nombre".
        $imagen->imagen = "img/" . $validados['imagen']->getClientOriginalName();
        $imagen->producto_id = $id;
        $imagen->save();

        return redirect('/productos')
            ->with('success', 'Imagen añadida correctamente');
    }

    //Funcion dedicada al admin
    //Basicamente borra el producto sin dejar rastro, el problema es que arrastra con él a todas las
    //tablas que tengan datos sobre el producto, la mitad de la aplicacion practicamente.
    public function destroy($id)
    {
        //Esto te borra la imagen y el comentario y finalmente el producto.
        $producto = Producto::findOrFail($id);
        $imagenes = count($producto->imagenes);
        $comentarios = count($producto->comentarios);
        if ($imagenes > 0) {
            for ($i=0; $i < $imagenes; $i++) {
            $producto->imagenes[$i]->delete();
            }
        }
        if ($comentarios > 0) {
            for ($i=0; $i < $comentarios; $i++) {
            $producto->comentarios[$i]->delete();
            }
        }
        $producto->delete();

        return redirect()->back()
            ->with('success', 'Producto borrado correctamente');
    }

    //Esta funcion te lleva a los detalles del producto
    public function producto(Producto $producto)
    {
        $imagenes = Imagen::where('producto_id', $producto->id);
        return view('productos.producto', [
            'producto' => $producto,
            'imagenes' => $imagenes
        ]);
    }

    //Funcion dedicada al admin
    //Funcion que permite cambiar una columna "estado" dentro de la tabla producto, esto permite
    //"Borrar" una pelicula a los usuarios pero mantiendola en la vista del admin, de esta forma se mantienen
    //todos los datos de el producto en cuestión en las tablas que dependen de él.
    public function cambiarEstado(Producto $producto)
    {
        $producto->estado = !$producto->estado;
        $producto->save();

        return redirect()->back()->with('success', 'Estado cambiado correctamente.');
    }

}
