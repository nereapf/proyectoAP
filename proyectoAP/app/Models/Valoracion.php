<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    protected $fillable = ['puntuacion', 'producto_id'];

    public function producto(){
        return $this->belongsTo(Producto::class);
    }
}
