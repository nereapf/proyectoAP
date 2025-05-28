<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Catalogo;
use App\Models\GastosFabricacion;
use App\Models\Material;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $campos = Schema::getColumnListing('productos');
        $exclude =["created_at","updated_at"];
        $campos = array_diff($campos,$exclude);
        $filas = Producto::select($campos)->get();

        $totalProductos = Producto::count();

        return view('productos.index',compact('filas','campos', 'totalProductos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $materiales = Material::all();
        $gastos = GastosFabricacion::all();

        return view('productos.create', compact('materiales', 'gastos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request){
        $rutaFoto = null;
        if ($request->hasFile('foto')) {
            $rutaFoto = $request->file('foto')->store('fotos', 'public');
        }

        $costoTotal = 0;
        foreach ($request->materiales as $material) {
            $mat = Material::find($material['material_id']);
            $metros = floatval($material['metros'] ?? 0);

            $costoTotal += $mat->precio_m2 * $metros;
        }
        if (!empty($request->gastos)) {
            foreach ($request->gastos as $gasto) {
                $gastoModel = GastosFabricacion::find($gasto['gasto_id']);
                $horas = floatval($gasto['horas'] ?? 0);
                $costoTotal += $gastoModel->precio_hora * $horas;
            }
        }

        $incremento = floatval($request->incremento ?? 0);
        $precioTotal = $costoTotal * (1 + ($incremento / 100));

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'foto' => $rutaFoto,
            'medidas' => $request->medidas,
            'color' => $request->color,
            'precio' => $precioTotal,
            'incremento' => $request->incremento,
            'catalogo_id' => null
        ]);

        foreach ($request->materiales as $material) {
            $producto->materiales()->attach($material['material_id'], [
                'm2' => $material['metros'],
                'principal' => $material['principal'] ?? false
            ]);
        }
        foreach ($request->gastos as $gasto) {
            $producto->gastos()->attach($gasto['gasto_id'], [
                'horas' => $gasto['horas']
            ]);
        }

        $producto->save();
        session()->flash("mensaje","$producto->nombre ha sido añadido a la lista de productos.");
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto){
        return view('productos.show',compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto){
        $producto->load('materiales', 'gastos');
        $materiales = Material::all();
        $gastos = GastosFabricacion::all();
        return view('productos.edit',compact('producto', 'materiales', 'gastos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto){
        $producto->update($request->input());
        $producto->materiales()->sync($request->materiales);
        $producto->gastos()->sync($request->gastos);
        session()->flash("mensaje","El producto $producto->nombre ha sido actualizado.");
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto){
        $producto->valoraciones()->delete();
        $producto->delete();
        session()->flash("mensaje","El producto $producto->nombre ha sido eliminado.");
        return redirect()->route('productos.index');
    }

}
