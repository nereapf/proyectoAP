<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiales';
    protected $fillable = ['nombre', 'foto', 'precio_m2'];

    public function productos(){
        return $this->belongsToMany(Producto::class, 'material_producto')
            ->withPivot('m2', 'principal')
            ->withTimestamps();
    }
}
