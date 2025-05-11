<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGastoRequest;
use App\Http\Requests\UpdateGastoRequest;
use App\Models\GastosFabricacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class GastosFabricacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $campos = Schema::getColumnListing('gastos_fabricacion');
        $exclude =["created_at","updated_at"];
        $campos = array_diff($campos,$exclude);
        $filas = GastosFabricacion::select($campos)->get();

        $totalGastos = GastosFabricacion::count();

        return view('gastos.index',compact('filas','campos', 'totalGastos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view("gastos.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGastoRequest $request)
    {
        $datos = $request->only("nombre","precio_hora");
        $gasto = new GastosFabricacion($datos);
        $gasto->save();

        session()->flash("mensaje","$gasto->nombre ha sido añadido a la lista de gastos.");
        return redirect()->route('gastos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(GastosFabricacion $gasto){
        return view('gastos.show',compact('gasto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GastosFabricacion $gasto){
        return view('gastos.edit',compact('gasto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGastoRequest $request, GastosFabricacion $gasto){
        $gasto->update($request->input());
        session()->flash("mensaje","El gasto $gasto->nombre ha sido actualizado.");
        return redirect()->route('gastos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GastosFabricacion $gasto){
        $gasto->delete();
        session()->flash("mensaje","El gasto $gasto->nombre ha sido eliminado.");
        return redirect()->route('gastos.index');
    }
}
