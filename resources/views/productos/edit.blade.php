<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar producto</title>
    @vite (["resources/css/app.css", "resources/js/app.js"])
</head>
<body class="flex flex-col min-h-screen">
<div class="bg-azulFondo min-h-screen flex items-center justify-center pt-20 pb-10">
    <div class="relative w-full max-w-sm">
        <div class="absolute -top-16 left-1/2 transform -translate-x-1/2">
            <div class="bg-white rounded-full">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 h-32 object-contain">
            </div>
        </div>
        <div class="bg-white rounded-xl pt-20 pb-8 px-8 shadow-md">
            <h2 class="text-2xl font-bold text-center mb-6">Editar Producto</h2>
            <form onsubmit=event.preventDefault() action="{{ route('productos.update', $producto->id) }}" id="formulario{{$producto->id}}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label for="nombre" :value="'Nombre'"/>
                    <x-text-input id="nombre" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700"
                                  type="text" name="nombre" value="{{$producto->nombre}}"/>
                    @error("nombre")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <div>
                    <x-input-label for="medidas" :value="'Medidas (cm)'"/>
                    <x-text-input id="medidas" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700"
                                  type="text" name="medidas" value="{{$producto->medidas}}"/>
                    @error("medidas")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <div>
                    <x-input-label for="color" :value="'Color'"/>
                    <x-text-input id="color" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700"
                                  type="text" name="color" value="{{$producto->color}}"/>
                    @error("color")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <div>
                    <x-input-label for="foto" :value="'Foto'"/>
                    <x-text-input id="foto" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700 text-xs"
                                  type="file" name="foto"/>
                    @if($producto->foto)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $producto->foto) }}" alt="Foto actual" class="w-16 h-16 rounded border">
                            <span class="text-xs text-gray-500">Foto actual</span>
                        </div>
                    @endif
                    @error("foto")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <fieldset id="contenedorMateriales">
                    <legend class="block text-sm font-semibold mb-1 text-gray-700">Materiales</legend>
                    @foreach($producto->materiales as $i => $material)
                        <div class="flex items-center gap-2 mb-2">
                            <select name="materiales[{{ $i }}][material_id]" class="border rounded px-1 py-1 flex-1" required>
                                <option value="">Seleccionar material...</option>
                                @foreach($materiales as $mat)
                                    <option value="{{ $mat->id }}" @if($mat->id == $material->id) selected @endif>
                                        {{ $mat->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="number" name="materiales[{{ $i }}][metros]" min="0" sstep="0.01" placeholder="m²"
                                   class="border rounded px-1 py-1 w-12" required value="{{ old("materiales.$i.metros", $material->pivot->m2) }}">
                            <div>
                                <input type="checkbox" name="materiales[{{ $i }}][principal]" value="1"
                                       @if($material->pivot->principal) checked @endif>
                                <span class="text-xs">¿Principal?</span>
                            </div>
                        </div>
                    @endforeach
                </fieldset>
                <button type="button" onclick="otroMaterial()" class="mb-4 bg-azulBordes hover:bg-azulBoton hover:texto-white text-azulOscuro px-2 py-0.5 rounded">Añadir otro material</button>

                <div id="contenedorGastos">
                    <label class="block text-sm font-semibold mb-1 text-gray-700">Gastos</label>
                    @foreach($producto->gastos as $j => $gasto)
                        <div class="flex items-center gap-1 mb-2">
                            <select name="gastos[{{ $j }}][gasto_id]" class="border rounded px-2 py-1 flex-1" required>
                                <option value="">Seleccionar gasto...</option>
                                @foreach($gastos as $g)
                                    <option value="{{ $g->id }}" @if($g->id == $gasto->id) selected @endif>
                                        {{ $g->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="number" name="gastos[{{ $j }}][horas]" min="0" step="0.01" placeholder="Horas/Cantidad"
                                   class="border rounded px-2 py-1 w-28" required value="{{ old("gastos.$j.horas", $gasto->pivot->horas) }}">
                        </div>
                    @endforeach
                </div>
                <button type="button" onclick="otroGasto()" class="mb-4 bg-azulBordes hover:bg-azulBoton hover:texto-white text-azulOscuro px-2 py-0.5 rounded">Añadir otro gasto</button>

                <div>
                    <x-input-label for="incremento" :value="'Incremento (%)'"/>
                    <x-text-input id="incremento" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700"
                                  type="number" name="incremento" min="0" step="0.01" value="{{$producto->incremento}}"/>
                    @error("incremento")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <div class="flex space-x-2">
                    <button type="button" onclick="confirmUpdate({{$producto->id}})"
                            class="w-full bg-black text-white font-semibold py-2 mt-8 rounded transition hover:bg-azulBoton">
                        Confirmar
                    </button>
                    <a href="{{route('productos.index')}}" class="px-3 bg-black text-white font-semibold py-2 mt-8 rounded transition hover:bg-red-800">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function confirmUpdate(id) {
        swal({
            title: "¿Deseas actualizar este producto?",
            text: "Esta acción no se podrá deshacer",
            icon: "warning",
            buttons: true
        }).then(function(ok) {
            if (ok) {
                let formulario = document.getElementById("formulario" + id);
                formulario.submit();
            }
        })
    }
</script>
</body>
</html>
