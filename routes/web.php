<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\LineaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoAdminController;
use App\Http\Controllers\StripeController;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/stripe-payment/{total}', [StripeController::class, 'handleGet'])->name('pagar');
Route::post('/stripe-payment', [StripeController::class, 'handlePost'])->name('stripe.payment');

Route::get('/', function () {
    $productos = Producto::all();
    return view('welcome', ['productos' => $productos]);
});


Route::middleware(['auth'])->group(function () {

    Route::resource('carritos', CarritoController::class);

    Route::get('/productos', [ProductoController::class, 'index'])->name('productos');

    Route::get('/contacto', [DireccionController::class, 'contacto'])->name('contacto');

    Route::post('/anadircomentario', [ComentarioController::class, 'anadircomentario'])
        ->name('anadircomentario');

        Route::post('/anadirrespuesta', [ComentarioController::class, 'anadirrespuesta'])
        ->name('anadirrespuesta');

    Route::get('/direccion', [DireccionController::class, 'index'])->name('indexDireccion');
    Route::get('/editDireccion', [DireccionController::class, 'edit'])->name('editDireccion');

    Route::post('/direccion/{user}', [DireccionController::class, 'direccion'])->name('direccion');

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
    /* Route::resource('todosLosPedidos', PedidoAdminController::class)
        ->middleware(['auth', 'can:solo-admin']); */
});

Route::middleware(['auth', 'can:solo-admin'])->group(function () {

    Route::get('/todosLosPedidos', [PedidoAdminController::class, 'index'])->name('todosLosPedidos');
    Route::get('/completados', [PedidoAdminController::class, 'completados'])->name('completados');

    Route::get('/productos/index', [ProductoController::class, 'edit']);
    Route::get('/productos/create', [ProductoController::class, 'create']);
    Route::post('/productos', [ProductoController::class, 'store'])
        ->name('productos.store');

        Route::get('/productos/{id}/anadirImagen', [ProductoController::class, 'setImagen']);

        Route::post('/producto/{id}', [ProductoController::class, 'postImagen'])
        ->name('imagen.store');

        Route::get('/productos/{id}/edit', [ProductoController::class, 'edit']);
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);
    Route::put('/productos/{id}', [ProductoController::class, 'update'])
        ->name('productos.update');



});

require __DIR__.'/auth.php';
