<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    //Nota: El modelo te permite relacionar las tablas entre ellas para poder recorrer las tablas que
    //tengan alguna relacion entre sí.

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function pedido()
    // {
    //     return $this->belongsTo(Pedido::class);
    // }
}
