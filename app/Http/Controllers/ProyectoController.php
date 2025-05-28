<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProyectoRequest;
use App\Http\Requests\UpdateProyectoRequest;
use App\Models\Producto;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $campos = Schema::getColumnListing('proyectos');
        $exclude =["created_at","updated_at"];
        $campos = array_diff($campos,$exclude);
        $filas = Proyecto::select($campos)->get();

        $totalProyectos = Proyecto::count();

        return view('proyectos.index',compact('filas','campos', 'totalProyectos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $productos = Producto::all();
        return view("proyectos.create", compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProyectoRequest $request){
        $fotos = [];
        if ($request->hasFile('fotos_productos')) {
            foreach ($request->file('fotos_productos') as $foto) {
                $ruta = $foto->store('proyectos/fotos_productos', 'public');
                $fotos[] = $ruta;
            }
        }

        $proyecto = Proyecto::create([
            'nombre' => $request->nombre,
            'empresa' => $request->empresa,
            'fotos_productos' => json_encode($fotos)
        ]);

        if ($request->has('productos')) {
            $proyecto->productos()->attach($request->productos);
        }

        $proyecto->save();
        session()->flash("mensaje","$proyecto->nombre ha sido añadido a la lista de proyectos.");
        return redirect()->route('proyectos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto){
        return view('proyectos.show',compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto){
        $proyecto->load('productos');
        $productos= Producto::all();
        $productosSeleccionados = $proyecto->productos()->pluck('productos.id')->toArray();
        return view('proyectos.edit',compact('proyecto', 'productos', 'productosSeleccionados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProyectoRequest $request, Proyecto $proyecto){
        $proyecto->update($request->input());
        $proyecto->productos()->sync($request->productos);
        session()->flash("mensaje","El proyecto $proyecto->nombre ha sido actualizado.");
        return redirect()->route('proyectos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto){
        $proyecto->delete();
        session()->flash("mensaje","El proyecto $proyecto->nombre ha sido eliminado.");
        return redirect()->route('proyectos.index');
    }
}
