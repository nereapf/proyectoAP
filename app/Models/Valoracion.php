<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    protected $table = 'valoraciones';
    protected $fillable = ['producto_id', 'valor'];

    public function producto(){
        return $this->belongsTo(Producto::class);
    }
}
