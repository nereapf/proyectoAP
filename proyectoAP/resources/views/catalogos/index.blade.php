<x-layouts.layout>
    <x-layouts.header />
    <div class="flex space-x-4">
        <div>
            <form action="{{ route('catalogo.add') }}" method="POST" class="flex flex-col items-center">
                @csrf
                <select name="producto_id">
                    <option value="">Añade un producto al catálogo</option>
                    @foreach($productosDisponibles as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-black text-white">
                    Añadir producto
                </button>
            </form>
        </div>
        <div>
            <form action="{{ route('catalogo.remove') }}" method="POST" class="flex flex-col items-center">
                @csrf
                <select name="producto_id">
                    <option value="">Elimina un producto del catálogo</option>
                    @foreach($productosCatalogo as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-black text-white">
                    Eliminar producto
                </button>
            </form>
        </div>
    </div>
    <div class="flex-1 flex flex-col items-center px-4">
        <div class="w-full max-w-7xl">
            @if(session('mensaje'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300">
                    {{ session('mensaje') }}
                </div>
            @endif
        </div>
        <div>
            @foreach($productosCatalogo as $producto)
                <div class="bg-white rounded-md overflow-hidden shadow-md">
                    <div class="h-36 mt-2 mx-2">
                        @if($producto->foto)
                            <img src="{{ asset('storage/' . $producto->foto) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">Sin imagen</div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold">{{ $producto->nombre }}</h3>
                        <div class="flex items-center">
                            <div class="flex">
                                <p>"estrellas"</p>
                            </div>
                        </div>
                        <p class="font-bold mt-2">{{$producto->precio, 2}}€</p>

                        <form action="{{ route('catalogo.remove') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                            <button type="submit" class="w-full bg-black text-white text-xs font-medium rounded-md px-4 py-2 hover:bg-gray-800">
                                Eliminar producto
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
    </script>
</x-layouts.layout>
