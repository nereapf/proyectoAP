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
        return view("valoraciones.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreValoracionRequest $request){
        $datos = $request->only("puntuacion");
        $valoracion = new Valoracion($datos);
        $valoracion->save();

        session()->flash("mensaje","Valoración realizada.");
        return redirect()->route('valoraciones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Valoracion $valoracion){

        return view('valoraciones.show',compact('valoracion'));
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
