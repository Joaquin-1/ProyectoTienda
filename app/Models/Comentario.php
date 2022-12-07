<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stripe\UsageRecord;

class Comentario extends Model
{
    use HasFactory;

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function respuestas()
    {
        return $this->hasMany(Comentario::class,'comentario_id','id');
    }
}
