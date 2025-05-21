<x-layouts.layout>
    <x-layouts.header />
    <div class="w-full bg-azulBordes py-4 px-8 flex justify-between items-center shadow">
        <h1 class="text-2xl font-bold text-blue-900 tracking-wide">GESTIÓN DE PRODUCTOS</h1>
        <a href="{{ route('productos.create') }}"
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
            @foreach($filas as $fila)
                <div class="border rounded p-4 mb-6 bg-white shadow">
                    <h2 class="text-xl font-semibold mb-2">{{ $fila->nombre }}</h2>
                    <div class="flex gap-4 mb-2">
                        <div class="w-32 h-32 bg-gray-200 flex items-center justify-center">
                            @if($fila->foto)
                                <img src="{{ asset('storage/' . $fila->foto) }}" alt="{{ $fila->nombre }}" class="object-cover w-full h-full">
                            @else
                                <span class="text-gray-500">Sin imagen</span>
                            @endif
                        </div>

                        <div class="flex-1">
                            <ul class="list-disc list-inside text-gray-700">
                                <li><strong>Materiales:</strong>
                                    <ul class="list-disc list-inside ml-4">
                                        @foreach($fila->materiales as $material)
                                            <li>{{ $material->nombre }} - {{ $material->pivot->m2 }} m²</li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><strong>Medidas en cm y color:</strong> {{ $fila->medidas }} - {{ $fila->color }}</li>
                                <li><strong>Costos/Gastos:</strong>
                                    <ul class="list-disc list-inside ml-4">
                                        @foreach($fila->gastos as $gasto)
                                            <li>{{ $gasto->nombre }} - {{ $gasto->pivot->horas }} horas</li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><strong>Precio:</strong> {{ number_format($fila->precio, 2) }} €</li>
                            </ul>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('productos.edit', $fila) }}" class="bg-yellow-400 px-4 py-2 rounded text-white hover:bg-yellow-500">Editar</a>

                        <form onsubmit="event.preventDefault()" action="{{ route('productos.destroy', $fila->id) }}" id="formulario{{$fila->id}}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="confirmDelete({{$fila->id}})"
                                    class="bg-red-600 px-4 py-2 rounded text-white hover:bg-red-700">
                                Borrar
                            </button>
                        </form>
                        <button type="button" class="bg-gray-500 px-4 py-2 rounded text-white">Comparar con mercado</button>
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
    </script>
</x-layouts.layout>
