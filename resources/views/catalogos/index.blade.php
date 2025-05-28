<x-layouts.layout>
    <x-layouts.header />
    <div class="flex space-x-4">
        @if(session('mensaje'))
            <div id="mensaje" class="fixed top-6 left-1/2 -translate-x-1/2 bg-green-100 text-green-800 px-6 py-3 rounded-xl shadow-lg z-50 transition-opacity">
                {{ session('mensaje') }}
            </div>
        @endif
        <div class="w-full max-w-4xl mx-auto mt-8 mb-10">
            <h2 class="text-3xl font-extrabold text-blue-900 mb-2 flex items-center justify-center gap-2">
                Gestión de Catálogo
            </h2>
            <div class="rounded-3xl shadow-lg p-6 flex flex-col md:flex-row items-center gap-5 border border-azulBordes">
                <div class="w-full md:w-1/2 flex flex-col gap-6">
                    <form action="{{ route('catalogo.add') }}" method="POST" class="flex flex-col gap-3 bg-azulFondo bg-opacity-80 rounded-xl p-4 shadow">
                        @csrf
                        <select name="producto_id" class="rounded-lg border border-azulBordes">
                            <option value="">Selecciona un producto...</option>
                            @foreach($productosDisponibles as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="mt-2 bg-green-300 text-green-700 font-semibold rounded-lg py-2 hover:bg-green-400 transition">
                            Añadir al catálogo
                        </button>
                    </form>
                </div>
                <div class="w-full md:w-1/2 flex flex-col gap-6">
                    <form action="{{ route('catalogo.remove') }}" method="POST" class="flex flex-col gap-3 bg-azulFondo bg-opacity-80 rounded-xl p-4 shadow">
                        @csrf
                        <select name="producto_id" class="rounded-lg border border-azulBordes">
                            <option value="">Selecciona un producto...</option>
                            @foreach($productosCatalogo as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="mt-2 bg-red-300 text-red-700 font-semibold rounded-lg py-2 hover:bg-red-400 transition">
                            Eliminar del catálogo
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-center mb-8">
        <input type="text" id="buscar" placeholder="Buscar producto en el catálogo..."
               class="w-full max-w-md p-3 border border-blue-200 rounded-xl shadow focus:ring-2 focus:ring-blue-400 transition" />
    </div>

    <div class="flex-1 flex flex-col items-center px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($productosCatalogo as $producto)
                <div class="producto bg-white rounded-md overflow-hidden shadow-md">
                    <div class="h-36 mt-2 mx-2 pt-5 flex items-center justify-center">
                        @if($producto->foto)
                            <img src="{{ asset('storage/' . $producto->foto) }}" alt="{{ $producto->nombre }}" class="w-40 h-36 object-contain">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">Sin imagen</div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class=" nombreProducto font-bold">{{ $producto->nombre }}</h3>
                        <p class="font-bold mt-2">{{$producto->precio, 2}}€</p>

                        <form action="{{ route('catalogo.remove') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                            <button type="submit" class="w-full bg-azulOscuro text-white text-xs font-medium rounded-md px-4 py-2 hover:bg-azulBoton">
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
