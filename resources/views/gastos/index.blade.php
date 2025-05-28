<x-layouts.layout>
    <x-layouts.header />
    <div class="w-full bg-azulMenuSeleccionado py-5 px-8 flex flex-col sm:flex-row sm:justify-between sm:items-center shadow mb-8 rounded-b-2xl border-b border-blue-200">
        <h1 class="text-2xl font-extrabold text-azulOscuro tracking-wide flex items-center gap-2">
            GESTIÓN DE GASTOS DE FABRICACIÓN
        </h1>
        <a href="{{ route('gastos.create') }}"
           class="mt-4 sm:mt-0 bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-blue-800 transition">
            + Añadir
        </a>
    </div>

    <div class="flex justify-center">
        <input type="text" id="buscar" placeholder="Buscar gasto..."
               class="w-full max-w-md p-3 border border-blue-200 rounded-xl shadow focus:ring-2 focus:ring-blue-400 transition" />
    </div>

    <div class="flex-1 flex flex-col items-center px-4">
        <div class="w-full max-w-7xl">
            @if(session('mensaje'))
                <div id="mensaje" class="fixed top-6 left-1/2 -translate-x-1/2 bg-green-100 text-green-800 px-6 py-3 rounded-xl shadow-lg z-50 transition-opacity">
                    {{ session('mensaje') }}
                </div>
            @endif

            <div class="flex-1 flex flex-col items-center px-4">
                <div class="w-full max-w-2xl">
                    <fieldset class="bg-white rounded-xl border-2 border-azulBordes px-6 py-4 my-10">
                        <legend class="text-lg font-bold text-azulOscuro">Gastos registrados</legend>
                        <ul>
                            @forelse($filas as $fila)
                                <li class="gasto flex items-center justify-between py-2 border-b border-gray-200 last:border-b-0">
                                    <span class="nombreGasto font-medium text-gray-800">{{ $fila->nombre }}</span>
                                    <div class="flex gap-4">
                                        <span class="text-gray-700">{{$fila->precio_hora, 2}} €/hora</span>
                                        <a href="{{ route('gastos.edit', $fila->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-green-700 hover:text-green-800 size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('gastos.destroy', $fila->id) }}" method="POST" id="formulario{{$fila->id}}" class="inline" onsubmit="event.preventDefault()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Eliminar"
                                                    onclick="confirmDelete({{$fila->id}})"
                                                    class="text-red-600 hover:text-red-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hover:text-red-800 size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <li class="py-8 text-center text-gray-500">No hay gastos registrados.</li>
                            @endforelse
                        </ul>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(id) {
            swal({
                title: "¿Deseas eliminar este gasto?",
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
            document.querySelectorAll(".gasto").forEach((row) => {
                let nombre = row.querySelector(".nombreGasto").textContent;
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
