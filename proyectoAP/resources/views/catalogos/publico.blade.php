<x-layouts.layout>
    <header class="bg-white w-full pb-5">
        <a href="/" class="absolute top-4 left-4 bg-azulFondo hover:bg-blue-200 text-azulOscuro rounded-full p-2 shadow transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div class="flex flex-col items-center mt-5">
            <img src="{{ asset('images/logoCompleto.png') }}" alt="Accesorios Pellés"
                 class="w-56 h-56 object-contain mb-2">
        </div>
    </header>
</x-layouts.layout>
