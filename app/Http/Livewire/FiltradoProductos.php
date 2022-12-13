<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Producto;
use Livewire\Component;

class FiltradoProductos extends Component
{
    public $categoriaSelect = 'All';


    public function render()
    {


        if ($this->categoriaSelect == 'All')
        {
            $productos = Producto::all();
        }
         else {

            $categoriaLive = Categoria::where('nombre', $this->categoriaSelect)->get()[0]->id;
            $productos = Producto:: where('categoria_id', $categoriaLive)->get() ;

        }

        $categorias = Categoria::all();


        return view('livewire.filtrado-productos', [
            'productos' => $productos,
            'categorias' => $categorias,
        ]);

    }
}

