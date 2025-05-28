<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar proyecto</title>
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
            <h2 class="text-2xl font-bold text-center mb-6">Editar Proyecto</h2>
            <form action="{{ route('proyectos.update', $proyecto->id) }}" id="formulario{{$proyecto->id}}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label for="nombre" :value="'Nombre'"/>
                    <x-text-input id="nombre" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700"
                                  type="text" name="nombre" value="{{$proyecto->nombre}}"/>
                    @error("nombre")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <div>
                    <x-input-label for="empresa" :value="'Empresa cliente'"/>
                    <x-text-input id="empresa" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700"
                                  type="text" name="empresa" value="{{$proyecto->empresa}}"/>
                    @error("empresa")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <fieldset id="contenedorProductos" class="border-1 border-black rounded-xl p-4 mb-4 shadow">
                    <legend class="block text-sm font-semibold mb-2 text-gray-700">Productos</legend>
                    <div class="flex flex-col gap-2">
                        @foreach($productos as $prod)
                            <label class="flex items-center gap-3 px-2 py-1 rounded hover:bg-azulFondo">
                                <input type="checkbox" name="productos[]" value="{{ $prod->id }}"
                                       class="form-checkbox h-5 w-5 text-azulBordes border-gray-300 focus:ring-azulBordes"
                                       @if(in_array($prod->id, $productosSeleccionados)) checked @endif>
                                <span class="text-base text-gray-700">{{ $prod->nombre }}</span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>

                <div class="flex space-x-2">
                    <button type="button" onclick="confirmUpdate({{$proyecto->id}})"
                            class="w-full bg-black text-white font-semibold py-2 mt-8 rounded transition hover:bg-azulBoton">
                        Confirmar
                    </button>
                    <a href="{{route('proyectos.index')}}" class="px-3 bg-black text-white font-semibold py-2 mt-8 rounded transition hover:bg-red-800">
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
            title: "¿Deseas actualizar este proyecto?",
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
