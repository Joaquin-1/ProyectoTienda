<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Producto;
use Livewire\Component;

class FiltradoProductos extends Component
{

    //Livewire  se utilizan en las vistas Blade mediante la directiva
    //@livewire y se pueden acceder directamente a través de la URL sin necesidad de definir rutas

    public $categoriaSelect = 'All';
    public $ordenarSelect = 'Precio descendente';

    //Esta funcion te permite clasificar las peliculas por categorias y/o por precio de forma dinámica.
    //Aqui esta la funcion "index" del productoController.
    //Nota: Muchisimo mejor que ajax y más facil.
    public function render()
    {
        $query = Producto::query();

        if ($this->categoriaSelect != 'All') {
            $categoriaLive = Categoria::where('nombre', $this->categoriaSelect)->first();
            $query->where('categoria_id', $categoriaLive->id);
        }

        if ($this->ordenarSelect == 'Precio descendente') {
            $query->orderBy('precio', 'desc');
        } elseif ($this->ordenarSelect == 'Precio ascendente') {
            $query->orderBy('precio', 'asc');
        }



        $productos = $query->paginate(10);
        // $productos = $query->get();
        $categorias = Categoria::all();



        return view('livewire.filtrado-productos', [
            'productos' => $productos,
            'categorias' => $categorias,
        ]);
    }
}

