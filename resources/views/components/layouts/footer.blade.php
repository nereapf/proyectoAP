<footer class="w-full bg-azulFondo border-t-4 border-azulBordes mt-12 relative">
    <div class="px-4 py-4 flex flex-col md:flex-row items-start justify-center md:space-x-12">

        <div class="flex flex-col items-center md:items-start md:w-1/3">
            <img src="{{ asset('images/logoCompleto.png') }}" alt="Accesorios Pellés" class="ml-10 h-40">
        </div>

        <div class="md:w-1/3 flex flex-col md:text-right mt-4">
            <h3 class="font-semibold text-azulOscuro mb-2">Contacto</h3>
            <p class="text-xs text-gray-700">
                Empresa dedicada al metal, iluminación y baños<br>
                Dirección: Pol.Ind. La Noria, C/Río Ara, naves 2 y 3<br>
                50730 El Burgo de Ebro (Zaragoza)<br>
                Tel: 976 105 453<br>
                Email: accesoriospelles@gmail.com<br>
                Sitios web: www.accesoriospelles.es - www.luzdled.es
            </p>
        </div>

        <div class="md:w-1/3 flex flex-col items-center md:items-start mt-4 ">
            <h3 class="font-semibold text-azulOscuro mb-2">Distribuidor</h3>
            <img src="{{ asset('images/distribuidor.png') }}" alt="Distribuidor" class="h-14">
        </div>
    </div>

    <div class="absolute bottom-4 right-4">
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input type="submit" value="Cerrar sesión" class="bg-azulBoton text-white text-xs px-2 py-1 rounded hover:bg-azulOscuro transition opacity-80">
            </form>
        @else
            <a href="{{ route('login') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-azulBoton hover:text-azulOscuro opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M5.121 17.804A9.953 9.953 0 0112 15c2.28 0 4.37.76 6.002 2.044M15 11a3 3 0 11-6 0 3 3 0 016 0zM12 3C7.03 3 3 7.03 3 12s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9z" />
                </svg>
            </a>
        @endauth
    </div>
</footer>



