<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCatalogoRequest;
use App\Models\Catalogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $campos = Schema::getColumnListing('catalogos');
        $exclude =["created_at","updated_at"];
        $campos = array_diff($campos,$exclude);
        $filas = Catalogo::select($campos)->get();

        $totalCatalogos = Catalogo::count();

        return view('catalogos.index',compact('filas','campos', 'totalCatalogos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
}
