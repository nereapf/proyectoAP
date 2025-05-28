<x-layouts.layout>
    <x-layouts.header />
    <div class="w-full bg-azulMenuSeleccionado py-5 px-8 flex flex-col sm:flex-row sm:justify-between sm:items-center shadow mb-8 rounded-b-2xl border-b border-blue-200">
        <h1 class="text-2xl font-extrabold text-azulOscuro tracking-wide flex items-center gap-2">
            GESTIÓN DE MATERIALES
        </h1>
        <a href="{{ route('materiales.create') }}"
           class="mt-4 sm:mt-0 bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-blue-800 transition">
            + Añadir
        </a>
    </div>

    <div class="flex justify-center mb-8">
        <input type="text" id="buscar" placeholder="Buscar materiales..."
               class="w-full max-w-md p-3 border border-blue-200 rounded-xl shadow focus:ring-2 focus:ring-blue-400 transition" />
    </div>

    <div class="flex-1 flex flex-col items-center px-4">
        <div class="w-full max-w-7xl">
            @if(session('mensaje'))
                <div id="mensaje" class="fixed top-6 left-1/2 -translate-x-1/2 bg-green-100 text-green-800 px-6 py-3 rounded-xl shadow-lg z-50 transition-opacity">
                    {{ session('mensaje') }}
                </div>
            @endif
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 max-w-4xl mx-auto p-4">
                @foreach($filas as $fila)
                    <div class="material bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center border border-blue-200">
                        @if($fila->foto)
                            <img src="{{ asset('storage/' . $fila->foto) }}" alt="Foto" class="w-28 h-28 rounded-2xl border-4 border-blue-100 mb-4 shadow">
                        @else
                            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mb-4 text-gray-400 text-xl shadow">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                        @endif

                        <h2 class="nombreMaterial text-xl font-extrabold text-blue-900 mb-1 text-center tracking-tight">
                            {{ $fila->nombre }}
                        </h2>

                        <div class="flex items-center gap-2 mb-2">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                                {{$fila->precio_m2, 2}} €/m²
                            </span>
                        </div>

                        <div class="flex gap-2 mt-4 w-full justify-center">
                            <a href="{{ route('materiales.edit', $fila->id) }}"
                               class="bg-yellow-200 text-yellow-500 px-4 py-2 rounded-lg font-semibold hover:bg-yellow-500 hover:text-yellow-100 transition text-sm shadow">
                                Editar
                            </a>
                            <form onsubmit="event.preventDefault()" action="{{ route('materiales.destroy', $fila->id) }}" id="formulario{{$fila->id}}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="confirmDelete({{$fila->id}})"
                                        class="bg-red-300 text-red-800 px-4 py-2 rounded-lg font-semibold hover:bg-red-800 hover:text-red-200 transition text-sm shadow">
                                    Borrar
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
                title: "¿Deseas eliminar este material?",
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
            document.querySelectorAll(".material").forEach((row) => {
                let nombre = row.querySelector(".nombreMaterial").textContent;
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
