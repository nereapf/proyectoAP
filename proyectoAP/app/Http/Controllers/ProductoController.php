<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use Illuminate\Http\Request;
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
        return view("productos.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request){
        $rutaFoto = null;
        if ($request->hasFile('foto')) {
            $rutaFoto = $request->file('foto')->store('fotos', 'public');
        }
        $producto = Producto::create([
            'nombre' => $request->nombre,
            'foto' => $rutaFoto,
            'medidas' => $request->medidas,
            'color' => $request->color,
            'precio' => $request->precio,
            'catalogo_id' => $request->catalogo_id
        ]);

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
        return view('productos.edit',compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto){
        $producto->update($request->input());
        session()->flash("mensaje","El producto $producto->nombre ha sido actualizado.");
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto){
        $producto->delete();
        session()->flash("mensaje","El producto $producto->nombre ha sido eliminado.");
        return redirect()->route('productos.index');
    }
}
