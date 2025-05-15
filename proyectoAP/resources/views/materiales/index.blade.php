<x-layouts.layout>
    <x-layouts.header />
    <div class="w-full bg-azulBordes py-4 px-8 flex justify-between items-center shadow">
        <h1 class="text-2xl font-bold text-blue-900 tracking-wide">GESTIÓN DE MATERIALES</h1>
        <a href="{{ route('materiales.create') }}"
           class="bg-blue-700 text-white px-6 py-2 rounded font-semibold hover:bg-blue-800 transition">
            + Añadir
        </a>
    </div>

    <div class="flex-1 flex flex-col items-center px-4">
        <div class="w-full max-w-7xl">
            @if(session('mensaje'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300">
                    {{ session('mensaje') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
                @forelse($filas as $fila)
                    <div class="bg-white rounded-xl shadow-md p-4 flex flex-col items-center">
                        @if($fila->foto)
                            <img src="{{ asset('storage/' . $fila->foto) }}" alt="Foto" class="w-24 h-24 rounded border object-cover mb-3">
                        @else
                            <div class="w-24 h-24 bg-gray-200 rounded flex items-center justify-center mb-3 text-gray-400">Sin foto</div>
                        @endif
                        <h2 class="text-lg font-bold text-blue-900 mb-2 text-center">{{ $fila->nombre }}</h2>
                        <ul class="text-sm text-gray-700 mb-2 text-left w-full list-disc pl-4">
                            <li>Precio: <span class="font-semibold">{{ ($fila->precio_m2) }} €/m²</span></li>
                        </ul>
                        <div class="flex gap-2 mt-2">
                            <a href="{{ route('materiales.edit', $fila->id) }}"
                               class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-800 transition text-sm">
                                Editar
                            </a>
                            <form onsubmit="event.preventDefault()" action="{{ route('materiales.destroy', $fila->id) }}" id="formulario{{$fila->id}}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="confirmDelete({{$fila->id}})"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-800 transition text-sm">
                                    Borrar
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-5 text-center text-gray-500 py-16">
                        No hay materiales registrados.
                    </div>
                @endforelse
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
    </script>
</x-layouts.layout>
