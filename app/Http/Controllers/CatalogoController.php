<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCatalogoRequest;
use App\Models\Catalogo;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $catalogo = Catalogo::where('nombre', 'principal')->first();
        $productosCatalogo = $catalogo ? $catalogo->productos : collect();

        $productosDisponibles = Producto::where(function ($query) use ($catalogo) {
            if ($catalogo) {
                $query->whereNull('catalogo_id')
                    ->orWhere('catalogo_id', '!=', $catalogo->id);
            } else {
                $query->whereNull('catalogo_id');
            }
        })->get();

        return view('catalogos.index', compact('catalogo', 'productosCatalogo', 'productosDisponibles'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCatalogoRequest $request){
        $datos = $request->only("nombre");
        $catalogo = new Catalogo($datos);
        $catalogo->save();

        return redirect()->route('catalogos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Catalogo $catalogo){
        return view('catalgos.show',compact('catalogo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addProducto(Request $request){
        $catalogo = Catalogo::where('nombre', 'principal')->first();
        if ($catalogo) {
            $producto = Producto::find($request->producto_id);
            if ($producto) {
                $producto->catalogo_id = $catalogo->id;
                $producto->save();
            }
        }
        return redirect()->route('catalogos.index');
    }

    public function removeProducto(Request $request){
        $producto = Producto::find($request->producto_id);
        if ($producto) {
            $producto->catalogo_id = null;
            $producto->save();
        }
        return redirect()->route('catalogos.index');
    }

    public function catalogoPublico() {
        $catalogo = Catalogo::where('nombre', 'principal')->first();
        $productosCatalogo = $catalogo ? $catalogo->productos : collect();
        return view('catalogos.publico', compact('catalogo', 'productosCatalogo'));
    }

    public function verProducto($id){
        $producto = Producto::with(['valoraciones'])->findOrFail($id);
        return view('productos.show', compact('producto'));
    }

}
