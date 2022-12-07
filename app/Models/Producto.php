<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function carritos()
    {
        return $this->hasMany(Carrito::class);
    }

    public function lineas()
    {
        return $this->hasMany(Linea::class);
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
