<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Producto;
use Livewire\Component;

class FiltradoProductos extends Component
{
    public $categoriaSelect = 'All';

    public $ordenarSelect = 'Precio descendente';


    public function render()
    {

        if ($this->categoriaSelect == 'All' && $this->ordenarSelect == 'Precio descendente')
        {
            $productos = Producto::all();
            $productos = Producto::orderBy('precio','desc')->get();
        }
         elseif ($this->categoriaSelect == 'All') {

            $productos = Producto::all();
            $productos = Producto::orderBy('precio','asc')->get();

        } else {
            $categoriaLive = Categoria::where('nombre', $this->categoriaSelect)->get()[0]->id;
            $productos = Producto:: where('categoria_id', $categoriaLive)->get();
        }

        // if ($this->ordenarSelect == 'Precio descendente')
        // {

        //     $productos = Producto::orderBy('precio','desc')->get();
        // }
        //  else {

        //     $productos = Producto::orderBy('precio','asc')->get();


        // }



        // dd($ordenarSelect);

        $categorias = Categoria::all();

        // dd($categorias)
        return view('livewire.filtrado-productos', [
            'productos' => $productos,
            'categorias' => $categorias,

        ]);

    }
}

