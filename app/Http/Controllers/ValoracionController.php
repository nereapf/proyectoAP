<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreValoracionRequest;
use App\Models\Valoracion;
use Illuminate\Http\Request;

class ValoracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreValoracionRequest $request, $productoId){
        $datos = $request->only("valor");
        $datos['producto_id'] = $productoId;
        $valoracion = new Valoracion($datos);
        $valoracion->save();

        session()->flash("mensaje","Calificación enviada, gracias por valorar el producto.");
        return redirect()->route('producto.show', $productoId);
    }

    /**
     * Display the specified resource.
     */
    public function show(Valoracion $valoracion){

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
