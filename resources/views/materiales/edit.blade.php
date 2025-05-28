<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar material</title>
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
            <h2 class="text-2xl font-bold text-center mb-6">Editar Material</h2>
            <form onsubmit=event.preventDefault() action="{{ route('materiales.update', $material->id) }}" id="formulario{{$material->id}}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label for="nombre" :value="'Nombre'"/>
                    <x-text-input id="nombre" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700"
                                  type="text" name="nombre" value="{{$material->nombre}}"/>
                    @error("nombre")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <div>
                    <x-input-label for="precio_m2" :value="'Precio por m²'"/>
                    <x-text-input id="precio_m2" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700"
                                  type="number" name="precio_m2" min="0" step="0.01" value="{{$material->precio_m2}}"/>
                    @error("precio_m2")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <div>
                    <x-input-label for="foto" :value="'Foto'"/>
                    <x-text-input id="foto" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700 text-xs"
                                  type="file" name="foto"/>
                    @if($material->foto)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $material->foto) }}" alt="Foto actual" class="w-16 h-16 rounded border">
                            <span class="text-xs text-gray-500">Foto actual</span>
                        </div>
                    @endif
                    @error("foto")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <div class="flex space-x-2">
                    <button type="button" onclick="confirmUpdate({{$material->id}})"
                            class="w-full bg-black text-white font-semibold py-2 mt-8 rounded transition hover:bg-azulBoton">
                        Confirmar
                    </button>
                    <a href="{{route('materiales.index')}}" class="px-3 bg-black text-white font-semibold py-2 mt-8 rounded transition hover:bg-red-800">
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
            title: "¿Deseas actualizar este material?",
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
