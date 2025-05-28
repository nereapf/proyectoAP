<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuevo gasto</title>
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
            <h2 class="text-2xl font-bold text-center mb-6">Añadir Nuevo Gasto</h2>
            <form action="{{ route('gastos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <x-input-label for="nombre" :value="'Concepto'"/>
                    <x-text-input id="nombre" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700"
                                  type="text" name="nombre" value="{{old('nombre')}}"/>
                    @error("nombre")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <div>
                    <x-input-label for="precio_hora" :value="'Precio por hora / Cantidad'"/>
                    <x-text-input id="precio_hora" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700"
                                  type="number" name="precio_hora" min="0" step="0.01" value="{{old('precio_hora')}}"/>
                    @error("precio_hora")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <div class="flex space-x-2">
                    <button type="submit"
                            class="w-full bg-black text-white font-semibold py-2 mt-8 rounded transition hover:bg-azulBoton">
                        Confirmar
                    </button>
                    <a href="{{route('gastos.index')}}" class="px-3 bg-black text-white font-semibold py-2 mt-8 rounded transition hover:bg-red-800">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
