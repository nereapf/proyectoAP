<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = ['nombre', 'empresa'];

    protected $casts = ['fotos_productos' => 'array'];

    public function productos(){
        return $this->belongsToMany(Producto::class, 'producto_proyecto')
            ->withTimestamps();
    }
}
