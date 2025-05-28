<x-layouts.layout>
    <x-layouts.header />
    <div class="w-full bg-azulMenuSeleccionado py-5 px-8 flex flex-col sm:flex-row sm:justify-between sm:items-center shadow mb-8 rounded-b-2xl border-b border-blue-200">
        <h1 class="text-2xl font-extrabold text-azulOscuro tracking-wide flex items-center gap-2">
            GESTIÓN DE PRODUCTOS
        </h1>
        <a href="{{ route('productos.create') }}"
           class="mt-4 sm:mt-0 bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-blue-800 transition">
            + Añadir
        </a>
    </div>

    <div class="flex justify-center mb-8">
        <input type="text" id="buscar" placeholder="Buscar producto..."
               class="w-full max-w-md p-3 border border-blue-200 rounded-xl shadow focus:ring-2 focus:ring-blue-400 transition" />
    </div>

    <div class="flex flex-col items-center px-4">
        <div class="w-full max-w-6xl space-y-8">
            @if(session('mensaje'))
                <div id="mensaje" class="fixed top-6 left-1/2 -translate-x-1/2 bg-green-100 text-green-800 px-6 py-3 rounded-xl shadow-lg z-50 transition-opacity">
                    {{ session('mensaje') }}
                </div>
            @endif

            @foreach($filas as $fila)
                <div class="producto bg-white border border-blue-100 rounded-2xl shadow-lg p-6 hover:shadow-2xl transition flex flex-col">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="w-full md:w-40 flex items-center justify-center rounded-xl overflow-hidden">
                            @if($fila->foto)
                                <img src="{{ asset('storage/' . $fila->foto) }}" alt="{{ $fila->nombre }}" class="object-cover w-40 h-40" />
                            @endif
                        </div>
                        <div class="flex-1 flex flex-col justify-center gap-2">
                            <h2 class="nombreProducto text-xl font-extrabold text-azulBoton mb-2">{{ $fila->nombre }}</h2>
                            <div>
                                <span class="font-semibold text-azulOscuro">Materiales:</span>
                                <span>
                                    @foreach($fila->materiales as $material)
                                        {{ $material->nombre }} - {{ $material->pivot->m2 }} m²
                                    @endforeach
                                </span>
                            </div>
                            <div>
                                <span class="font-semibold text-azulOscuro">Medidas y color:</span>
                                <span>{{ $fila->medidas }} - {{ $fila->color }}</span>
                            </div>

                            <div>
                                <span class="font-semibold text-azulOscuro">Costos/Gastos:</span>
                                <span>
                                    @foreach($fila->gastos as $gasto)
                                        {{ $gasto->nombre }} - {{ $gasto->pivot->horas }} horas
                                    @endforeach
                                </span>
                            </div>

                            <div>
                                <span class="font-semibold text-azulOscuro">Precio:</span>
                                <span>{{ number_format($fila->precio, 2) }} €</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-6 pt-4 border-t border-blue-100">
                        <a href="{{ route('productos.edit', $fila) }}" class="bg-yellow-200 px-4 py-2 rounded-lg text-yellow-500 font-semibold hover:bg-yellow-500 hover:text-yellow-100 transition">Editar</a>
                        <form onsubmit="event.preventDefault()" action="{{ route('productos.destroy', $fila->id) }}" id="formulario{{$fila->id}}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="confirmDelete({{$fila->id}})"
                                    class="bg-red-300 px-4 py-2 rounded-lg text-red-800 font-semibold hover:bg-red-800 hover:text-red-200 transition">
                                Borrar
                            </button>
                        </form>
                        <form action="{{ route('comparar.precios') }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="hidden" name="producto" value="{{ $fila->nombre }}">
                            <button type="submit" class="bg-azulBordes px-4 py-2 rounded-lg text-azulOscuro font-semibold hover:bg-azulBoton hover:text-white transition">
                                Comparar con mercado
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function confirmDelete(id) {
            swal({
                title: "¿Deseas eliminar este producto?",
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
            document.querySelectorAll(".producto").forEach((row) => {
                let nombre = row.querySelector(".nombreProducto").textContent;
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

