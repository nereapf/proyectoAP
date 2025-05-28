<x-layouts.layout>
    <x-layouts.header />
    <div class="w-full bg-azulMenuSeleccionado py-5 px-8 flex flex-col sm:flex-row sm:justify-between sm:items-center shadow mb-8 rounded-b-2xl border-b border-blue-200">
        <h1 class="text-2xl font-extrabold text-azulOscuro tracking-wide flex items-center gap-2">
            GESTIÓN DE PROYECTOS
        </h1>
        <a href="{{ route('proyectos.create') }}"
           class="mt-4 sm:mt-0 bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-blue-800 transition">
            + Añadir
        </a>
    </div>

    <div class="flex justify-center">
        <input type="text" id="buscar" placeholder="Buscar proyectos..."
               class="w-full max-w-md p-3 border border-blue-200 rounded-xl shadow focus:ring-2 focus:ring-blue-400 transition" />
    </div>

    <div class="flex-1 flex flex-col items-center px-4">
        <div class="w-full max-w-7xl">
            @if(session('mensaje'))
                <div id="mensaje" class="fixed top-6 left-1/2 -translate-x-1/2 bg-green-100 text-green-800 px-6 py-3 rounded-xl shadow-lg z-50 transition-opacity">
                    {{ session('mensaje') }}
                </div>
            @endif

            <div class="max-w-6xl mx-10 my-10">
                @foreach($filas as $fila)
                    <div class="proyecto bg-white rounded-xl shadow-lg mb-6 p-6 border border-blue-200">
                        <div class="border-b border-gray-200 pb-4 mb-4">
                            <h2 class="nombreProyecto text-xl font-bold text-azulOscuro">{{ $fila->nombre }}</h2>
                            <p class="text-gray-600">Cliente: {{ $fila->empresa }}</p>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($fila->productos as $producto)
                                <div class="bg-gray-50 rounded-lg p-4 shadow-sm">
                                    @if($producto->foto)
                                        <img src="{{ asset('storage/' . $producto->foto) }}"
                                             alt="{{ $producto->nombre }}"
                                             class="h-48 rounded-lg mb-4 mx-auto">
                                    @endif

                                    <h3 class="text-lg font-semibold text-azulOscuro mb-2">{{ $producto->nombre }}</h3>
                                    <div class="space-y-2 text-sm">
                                        <p><span class="font-semibold">Medidas:</span> {{ $producto->medidas }}</p>
                                        <p><span class="font-semibold">Color:</span> {{ $producto->color }}</p>

                                        <div class="mt-2">
                                            <p class="font-semibold">Materiales:</p>
                                            <ul class="list-disc pl-5">
                                                @foreach($producto->materiales as $material)
                                                    <li>
                                                        {{ $material->nombre }}
                                                        ({{ $material->pivot->m2 }} m²)
                                                        @if($material->pivot->principal)
                                                            <span class="text-xs text-azulBoton">(Principal)</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <div class="mt-2">
                                            <p class="font-semibold">Gastos de fabricación:</p>
                                            <ul class="list-disc pl-5">
                                                @foreach($producto->gastos as $gasto)
                                                    <li>{{ $gasto->nombre }} ({{ $gasto->pivot->horas }} horas)</li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <p class="mt-2 text-lg font-bold text-azulBordes">
                                            Precio: {{$producto->precio, 2}} €
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 flex gap-2 border-t pt-4">
                            <a href="{{ route('proyectos.edit', $fila) }}"
                               class="bg-yellow-200 text-yellow-500 font-semibold px-4 py-2 rounded hover:bg-yellow-500 hover:text-yellow-100 transition">
                                Editar
                            </a>
                            <form action="{{ route('proyectos.destroy', $fila) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-300 text-red-800 font-semibold px-4 py-2 rounded hover:bg-red-800 hover:text-red-200 transition"
                                        onclick="return confirm('¿Seguro que quieres eliminar este proyecto?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(id) {
            swal({
                title: "¿Deseas eliminar este proyecto?",
                text: "Esta acción no se podrá deshacer",
                icon: "warning",
                buttons: true
            }).then(function (ok) {
                if (ok) {
                    let formulario = document.getElementById("formulario" + id);
                    formulario.submit();
                }
            })
        }

        document.getElementById("buscar").addEventListener("input", function () {
            let texto = this.value.toLowerCase();
            document.querySelectorAll(".proyecto").forEach((row) => {
                let nombre = row.querySelector(".nombreProyecto").textContent;
                row.style.display = nombre.toLowerCase().includes(texto) ? "" : "none";
            })
        });

        setTimeout(() => {
            const mensaje = document.getElementById('mensaje');
            if (mensaje) {
                mensaje.style.opacity = '0';
                setTimeout(() => mensaje.remove(), 500);
            }
        }, 4000);
    </script>
</x-layouts.layout>
