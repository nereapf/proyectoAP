<x-layouts.layout>
    <header class="w-full bg-azulFondo flex flex-col items-center p-5">
        <a href="/" class="absolute top-4 left-4 bg-blue-200 hover:bg-blue-300 text-azulOscuro rounded-full p-2 shadow transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
                <img src="{{ asset('images/logo.png') }}" alt="Accesorios Pellés"
                     class="w-28 h-28 object-contain mb-2">
                <h1 class="text-4xl font-extrabold text-azulOscuro tracking-tight mb-2">Catálogo de Productos</h1>
                <p class="text-azulBoton font-bold text-sm">Descubre todos nuestros productos y encuentra el que mejor se adapta a tus necesidades.</p>

    </header>

    <div class="flex justify-center my-8">
        <input type="text" id="buscar" placeholder="Buscar productos en el catálogo..."
               class="w-full max-w-lg p-3 border border-blue-200 rounded-2xl shadow focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 max-w-5xl mx-auto p-4">
        @foreach($productosCatalogo as $producto)
            <a href="{{ route('producto.show', $producto->id) }}"
               class="productos rounded-2xl shadow-lg p-5 hover:ring-4 hover:ring-azulBordes transition-all duration-200">
                <div class="h-48 rounded-xl mb-3 flex items-center justify-center ">
                    <img src="{{ asset('storage/' . $producto->foto) }}" alt="{{ $producto->nombre }}"
                         class="object-cover h-48 w-52 rounded-xl transition-transform duration-200">
                </div>
                <div>
                    <h3 class="nombreProducto font-bold text-lg text-azulOscuro mb-1 text-center">{{ $producto->nombre }}</h3>
                    <div class="flex justify-center items-center mb-2">
                        @php
                            $media = $producto->valoraciones->avg('valor') ?? 0;
                        @endphp
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= round($media) ? 'text-amarilloEstrellas' : 'text-grisEstrellas' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <div class="text-md text-azulOscuro text-center mb-2">
                        {{$producto->precio, 2}} €
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <script>
        document.getElementById("buscar").addEventListener("input", function () {
            let texto = this.value.toLowerCase();
            document.querySelectorAll(".productos").forEach((row) => {
                let nombre = row.querySelector(".nombreProducto").textContent;
                row.style.display = nombre.toLowerCase().includes(texto) ? "" : "none";
            })
        });
    </script>
</x-layouts.layout>
