<x-layouts.layout>
    <header class="bg-white w-full pb-12 mb-6">
        <a href="{{ route('productos.index') }}" class="absolute top-4 left-4 bg-azulFondo hover:bg-blue-200 text-azulOscuro rounded-full p-2 shadow transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div class="flex items-center px-6 pt-6 pb-2 ml-20">
            <img src="{{ asset('images/logoconFondo.png') }}" alt="Logo Accesorios Pellés"
                 class="md:w-24 md:h-24 mr-4 -mb-14">
            <h1 class="text-2xl md:text-3xl font-extrabold text-azulBoton">
                {{ $producto }} en el mercado
            </h1>
        </div>
        <div class="w-full border-b-4 border-azulOscuro"></div>
    </header>
    <div class="relative rounded-2xl max-w-5xl mx-auto pb-12">
        @if(count($resultados))
            <ul class="space-y-6">
                @foreach($resultados as $producto)
                    <li class="flex gap-6 items-start p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-200">
                        @if(isset($producto['pagemap']['cse_image'][0]['src']))
                            <img
                                src="{{ $producto['pagemap']['cse_image'][0]['src'] }}"
                                class="w-28 h-28 rounded-lg border border-gray-200 bg-white object-cover"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                            >
                            <div style="display:none"
                                 class="w-28 h-28 flex items-center justify-center rounded-lg bg-white text-gray-400 border border-gray-200">
                            </div>
                        @else
                            <div style="display:flex"
                                 class="w-28 h-28 flex items-center justify-center rounded-lg bg-white text-gray-400 border border-gray-200">
                            </div>
                        @endif

                        <div class="flex-1">
                            <a href="{{ $producto['link'] }}" target="_blank"
                               class="block text-lg font-semibold text-blue-700 hover:text-blue-900 hover:underline transition">
                                {{ $producto['title'] }}
                            </a>
                            <p class="text-gray-600 mt-2 text-sm">
                                {{ $producto['snippet'] ?? '' }}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="p-6 bg-yellow-100 text-yellow-800 rounded-xl text-center mt-10 shadow">
                No se encontraron resultados para <strong>{{ $producto }}</strong>.
            </div>
        @endif
    </div>
    <div class="mt-10 flex justify-center">
        <a href="{{ route('productos.index') }}"
           class="inline-block bg-azulBoton text-white font-semibold px-8 py-3 rounded-xl shadow hover:bg-azulOscuro transition-colors duration-200">
            Volver a PRODUCTOS
        </a>
    </div>
</x-layouts.layout>


