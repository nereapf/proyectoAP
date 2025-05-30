<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'foto', 'medidas', 'color', 'precio', 'incremento', 'catalogo_id'];

    public function catalogo(){
        return $this->belongsTo(Catalogo::class);
    }

    public function materiales(){
        return $this->belongsToMany(Material::class, 'material_producto')
            ->withPivot('m2', 'principal')
            ->withTimestamps();
    }

    public function gastos(){
        return $this->belongsToMany(GastosFabricacion::class, 'gasto_producto','producto_id', 'gasto_id')
            ->withPivot('horas')
            ->withTimestamps();
    }

    public function valoraciones(){
        return $this->hasMany(Valoracion::class);
    }

    public function proyectos(){
        return $this->belongsToMany(Proyecto::class, 'producto_proyecto')
            ->withTimestamps();
    }

    public function actualizarPrecio(){
        $costoTotal = 0;

        foreach ($this->materiales as $material) {
            $costoTotal += $material->precio_m2 * $material->pivot->m2;
        }
        foreach ($this->gastos as $gasto) {
            $costoTotal += $gasto->precio_hora * $gasto->pivot->horas;
        }
        $this->precio = $costoTotal * (1 + ($this->incremento / 100));
        $this->save();
    }

}
