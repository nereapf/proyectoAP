<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'foto', 'medidas', 'color', 'precio', 'catalogo_id'];

    public function catalogo(){
        return $this->belongsTo(Catalogo::class);
    }

    public function materiales(){
        return $this->belongsToMany(Material::class, 'material_producto')
            ->withPivot('m2', 'principal')
            ->withTimestamps();
    }

    public function gastos(){
        return $this->belongsToMany(GastoFabricacion::class, 'gasto_producto')
            ->withTimestamps();
    }

    public function valoraciones(){
        return $this->hasMany(Valoracion::class);
    }

    public function proyectos(){
        return $this->belongsToMany(Proyecto::class, 'producto_proyecto')
            ->withTimestamps();
    }

    public function mediaValoraciones(){
    }
}
