<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\LineaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoAdminController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\FuturaspeliculasController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\SwitchView;
use App\Models\Comentario;
use App\Models\Contacto;
use App\Models\Futuraspeliculas;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Process;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Rutas para manejar el pago con tarjeta
Route::get('/stripe-payment/{total}', [StripeController::class, 'handleGet'])->name('pagar');
Route::post('/stripe-payment', [StripeController::class, 'handlePost'])->name('stripe.payment');



//Esta ruta te devuelve los datos de las peliculas y las futuras peliculas para verlos en la vista de la pagina de inicio
Route::get('/', function () {
    $productos = Producto::all();
    $futuraspeliculas = Futuraspeliculas::all();
    return view('welcome1', ['productos' => $productos,
                             'futuraspeliculas' => $futuraspeliculas]);
});




//Esto verifica si el usuario esta verificado, es decir estas rutas solo son accesibles para usuarios registrados.
Route::middleware(['auth', 'verified'])->group(function () {


    Route::resource('carritos', CarritoController::class);

    Route::resource('contactos', ContactoController::class);
    Route::get('/contactos', [ContactoController::class, 'index'])->name('contactos');
    Route::get('/contactos/create', [ContactoController::class, 'create']);
    Route::post('/contactos', [ContactoController::class, 'store'])->name('contactos.store');


    Route::get('/productos', [ProductoController::class, 'index'])->name('productos');






    Route::post('/anadircomentario', [ComentarioController::class, 'anadircomentario'])
        ->name('anadircomentario');

        Route::post('/anadirrespuesta', [ComentarioController::class, 'anadirrespuesta'])
        ->name('anadirrespuesta');


    Route::get('/direccion', [DireccionController::class, 'index'])->name('indexDireccion');

    Route::post('/direccion/{user}', [DireccionController::class, 'direccion'])->name('direccion');

    Route::get('/editDireccion', [DireccionController::class, 'edit'])->name('editDireccion');

    Route::post('/setDireccion/{direccion}', [DireccionController::class, 'setDireccion'])->name('setDireccion');



    Route::get('/producto/{producto}', [ProductoController::class, 'producto'])->name('producto');


    Route::resource('facturas', FacturaController::class);

    Route::post('/facturas/cambiar_estado', [FacturaController::class, 'cambiar_estado'])
        ->name('cambiar_estado');


    Route::post('/carritos/meter/{producto}', [CarritoController::class, 'anadiralcarrito'])
        ->name('anadiralcarrito');

    Route::post('/carritos/restar/{carrito}', [CarritoController::class, 'restar'])
        ->name('restar');

    Route::post('/carritos/sumar/{carrito}', [CarritoController::class, 'sumar'])
        ->name('sumar');

    Route::post('/carritos/vaciar', [CarritoController::class, 'vaciar'])
        ->name('vaciar');

    Route::post('/pedidoEstado/{linea}', [LineaController::class, 'edit'])
        ->name('edit');

        Route::post('/carritos/factura', [CarritoController::class, 'pedido'])
        ->name('pedido');


        Route::get('/completadosUser', [PedidoAdminController::class, 'completadosUser'])->name('completadosUser');


        Route::get('/perfiles', [UserController::class, 'index'])->name('perfiles');
        Route::get('/perfiles/{id}/edit', [UserController::class, 'edit']);
        Route::put('/perfiles/{id}', [UserController::class, 'update'])
        ->name('perfiles.update');


});


//Esto verifica si eres admin de la aplicacion, si es así te da acceso a las rutas que contiene.
Route::middleware(['auth', 'can:solo-admin'])->group(function () {



    Route::get('/futuraspeliculas/{id}/edit', [FuturaspeliculasController::class, 'edit']);
    Route::put('/futuraspeliculas/{id}', [FuturaspeliculasController::class, 'update'])
    ->name('futuraspeliculas.update');


    Route::delete('/contactos/{id}', [ContactoController::class, 'destroy']);


    Route::put('/productos/{producto}/cambiar-estado', [ProductoController::class, 'cambiarEstado'])
    ->name('productos.cambiar-estado');



    Route::get('/usuarios/ver-clientes', [UserController::class, 'verClientes'])->name('ver-clientes');
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy']);


    Route::delete('/comentarios/{id}', [ComentarioController::class, 'destroy']);


    Route::get('/todosLosPedidos', [PedidoAdminController::class, 'index'])->name('todosLosPedidos');
    Route::get('/completados', [PedidoAdminController::class, 'completados'])->name('completados');


    Route::get('/productos/create', [ProductoController::class, 'create']);
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');

        Route::get('/productos/{id}/anadirImagen', [ProductoController::class, 'setImagen']);
        Route::post('/producto/{id}', [ProductoController::class, 'postImagen'])
        ->name('imagen.store');

    Route::get('/productos/{id}/edit', [ProductoController::class, 'edit']);
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);
    Route::put('/productos/{id}', [ProductoController::class, 'update'])
        ->name('productos.update');



});

require __DIR__.'/auth.php';
