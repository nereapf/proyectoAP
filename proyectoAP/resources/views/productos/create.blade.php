<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuevo producto</title>
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
            <h2 class="text-2xl font-bold text-center mb-6">Añadir Nuevo Producto</h2>
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <x-input-label for="nombre" :value="'Nombre'"/>
                    <x-text-input id="nombre" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700"
                                  type="text" name="nombre" value="{{old('nombre')}}"/>
                    @error("nombre")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <div>
                    <x-input-label for="medidas" :value="'Medidas'"/>
                    <x-text-input id="medidas" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700"
                                  type="text" name="medidas" value="{{old('medidas')}}"/>
                    @error("medidas")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <div>
                    <x-input-label for="color" :value="'Color'"/>
                    <x-text-input id="color" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700"
                                  type="text" name="color" value="{{old('color')}}"/>
                    @error("color")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <div>
                    <x-input-label for="foto" :value="'Foto'"/>
                    <x-text-input id="foto" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700 text-xs"
                                  type="file" name="foto"/>
                    @error("foto")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <fieldset id="contenedorMateriales">
                    <legend class="block text-sm font-semibold mb-1 text-gray-700">Materiales</legend>
                    <div class="flex items-center gap-2 mb-2">
                        <select name="materiales[0][material_id]" class="border rounded px-1 py-1 flex-1" required>
                            <option value="">Seleccionar material...</option>
                            @foreach($materiales as $material)
                                <option value="{{ $material->id }}">{{ $material->nombre }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="materiales[0][metros]" min="0" step="any" placeholder="m²" class="border rounded px-1 py-1 w-12" required>
                        <div>
                            <input type="checkbox" name="materiales[0][principal]" value="1">
                            <span class="text-xs">¿Principal?</span>
                        </div>
                    </div>
                </fieldset>
                <button type="button" onclick="otroMaterial()" class="mb-4 bg-azulBordes hover:bg-azulBoton hover:texto-white text-azulOscuro px-2 py-0.5 rounded">Añadir otro material</button>

                <div id="contenedorGastos">
                    <label class="block text-sm font-semibold mb-1 text-gray-700">Gastos</label>
                    <div class="flex items-center gap-1 mb-2">
                        <select name="gastos[0][gasto_id]" class="border rounded px-2 py-1 flex-1">
                            <option value="">Seleccionar gasto...</option>
                            @foreach($gastos as $gasto)
                                <option value="{{ $gasto->id }}">{{ $gasto->nombre }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="gastos[0][horas]" placeholder="Horas/Cantidad" class="border rounded px-2 py-1 w-28" required>
                    </div>
                </div>
                <button type="button" onclick="otroGasto()" class="mb-4 bg-azulBordes hover:bg-azulBoton hover:texto-white text-azulOscuro px-2 py-0.5 rounded">Añadir otro gasto</button>

                <div>
                    <x-input-label for="incremento" :value="'Incremento (%)'"/>
                    <x-text-input id="incremento" class="mt-1 block w-full rounded border-gray-300 focus:border-blue-700 focus:ring-blue-700"
                                  type="number" name="incremento" value="{{old('incremento')}}"/>
                    @error("incremento")
                    <div class="text-sm text-red-600">{{$message}}</div>
                    @enderror
                </div>

                <div class="flex space-x-2">
                    <button type="submit"
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
    const materiales = @json($materiales);
    let numMaterial = 1;
    function otroMaterial() {
        let contenedor = document.getElementById('contenedorMateriales');
        let div = document.createElement('div');
        div.className = "flex items-center gap-2 mb-2";

        let select = document.createElement('select');
        select.name = `materiales[${numMaterial}][material_id]`;
        select.className = "border rounded px-1 py-1 flex-1";
        select.required = true;

        let seleccionar = document.createElement('option');
        seleccionar.value = "";
        seleccionar.text = "Seleccionar material...";
        select.appendChild(seleccionar);

        materiales.forEach(material => {
            let option = document.createElement('option');
            option.value = material.id;
            option.text = material.nombre;
            select.appendChild(option);
        });

        let inputMetros = document.createElement('input');
        inputMetros.type = "number";
        inputMetros.name = `materiales[${numMaterial}][metros]`;
        inputMetros.min = "0";
        inputMetros.step = "any";
        inputMetros.placeholder = "m²";
        inputMetros.className = "border rounded px-1 py-1 w-12";
        inputMetros.required = true;

        let div2 = document.createElement('div');
        let checkbox = document.createElement('input');
        checkbox.type = "checkbox";
        checkbox.name = `materiales[${numMaterial}][principal]`;
        checkbox.value = "1";
        div2.appendChild(checkbox);
        let span = document.createElement('span');
        span.className = "text-xs";
        span.innerText = "¿Principal?";
        div2.appendChild(span);

        div.appendChild(select);
        div.appendChild(inputMetros);
        div.appendChild(div2);

        contenedor.appendChild(div);
        numMaterial++;
    }

    const gastos = @json($gastos);
    let gastoIndex = 1;
    function otroGasto() {
        const contenedor = document.getElementById('contenedorGastos');
        const div = document.createElement('div');
        div.className = "flex items-center gap-1 mb-2";

        const select = document.createElement('select');
        select.name = `gastos[${gastoIndex}][gasto_id]`;
        select.className = "border rounded px-2 py-1 flex-1";
        select.required = true;

        const seleccionar = document.createElement('option');
        seleccionar.value = "";
        seleccionar.text = "Seleccionar gasto...";
        select.appendChild(seleccionar);

        gastos.forEach(gasto => {
            const option = document.createElement('option');
            option.value = gasto.id;
            option.text = gasto.nombre;
            select.appendChild(option);
        });

        const inputHoras = document.createElement('input');
        inputHoras.type = "number";
        inputHoras.name = `gastos[${gastoIndex}][horas]`;
        inputHoras.min = "0";
        inputHoras.step = "any";
        inputHoras.placeholder = "Horas/Cantidad";
        inputHoras.className = "border rounded px-2 py-1 w-28";
        inputHoras.required = true;

        div.appendChild(select);
        div.appendChild(inputHoras);

        contenedor.appendChild(div);
        gastoIndex++;
    }
</script>
</body>
</html>
