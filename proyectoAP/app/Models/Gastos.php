<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    protected $table = 'gastos_fabricacion';
    protected $fillable = ['nombre', 'precio_hora'];

    public function productos(){
        return $this->belongsToMany(Producto::class, 'gasto_producto')
            ->withTimestamps();
    }
}
