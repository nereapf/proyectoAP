<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Models\Material;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $campos = Schema::getColumnListing('materiales');
        $exclude =["created_at","updated_at"];
        $campos = array_diff($campos,$exclude);
        $filas = Material::select($campos)->get();

        $totalMateriales = Material::count();

        return view('materiales.index',compact('filas','campos', 'totalMateriales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view("materiales.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterialRequest $request){
        $ruta = null;

        $material = Material::create([
            'nombre' => $request->nombre,
            'precio_m2' => $request->precio_m2,
            'foto' => $ruta
        ]);

        if ($request->hasFile('foto')) {
            $ruta = $request->file('foto')->store('materiales', 'public');
            $material->foto = $ruta;
        }

        $material->save();
        session()->flash("mensaje","$material->nombre ha sido añadido a la lista de materiales.");
        return redirect()->route('materiales.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material){
        return view('materiales.show',compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material){
        return view('materiales.edit',compact('material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaterialRequest $request, Material $material){
        $campos = $request->only('nombre', 'precio_m2');

        if ($request->hasFile('foto')) {
            $campos['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $material->update($campos);
        session()->flash("mensaje","El material $material->nombre ha sido actualizado.");
        return redirect()->route('materiales.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material){
        $material->delete();
        session()->flash("mensaje","El material $material->nombre ha sido eliminado.");
        return redirect()->route('materiales.index');
    }
}
