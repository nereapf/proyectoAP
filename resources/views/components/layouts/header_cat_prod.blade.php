<header class="bg-white w-full pb-5">
    <a href="{{ route('catalogo.publico') }}" class="absolute top-4 left-4 bg-azulFondo hover:bg-blue-200 text-azulOscuro rounded-full p-2 shadow transition">
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
            Catálogo de productos
        </h1>
    </div>
    <div class="w-full border-b-4 border-azulOscuro"></div>
</header>
