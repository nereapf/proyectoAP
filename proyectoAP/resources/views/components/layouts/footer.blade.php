<footer class="w-full bg-azulFondo border-t-4 border-azulBordes mt-12">
    <div class="px-4 py-4 flex flex-col md:flex-row items-center">
        <div class="flex flex-col items-center md:items-start md:w-1/3">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logoCompleto.jpg') }}" alt="Accesorios Pellés" class="w-70 h-40">
            </div>
        </div>
        <div class="md:w-1/3 text-center md:text-right mb-6 md:mb-0">
            <h3 class="font-semibold text-azulOscuro mb-2">Contacto</h3>
            <p class="text-sm text-gray-700">
                Dirección: Calle Ejemplo 123, Ciudad<br>
                Tel: 123 456 789<br>
                Email: info@accesoriospelles.com
            </p>
        </div>
        <div class="md:w-1/3 flex flex-col items-center md:items-left space-y-3">
            <div>
                <h3 class="font-semibold text-azulOscuro mb-1">Distribuidor</h3>
                <img src="{{ asset('images/distribuidor.png') }}" alt="Distribuidor" class="h-30">
            </div>
            @auth
                <a href="#"
                   class="mt-2 inline-block bg-azulBoton text-white text-xs px-2 py-1 rounded hover:bg-azulOscuro transition opacity-60">
                    Acceso Adminsitrador
                </a>
            @else
                <a href="#"
                   class="mt-2 inline-block bg-azulBoton text-white text-xs px-2 py-1 rounded hover:bg-azulOscuro transition opacity-60">
                    Cerrar sesión
                </a>
            @endauth
        </div>

    </div>
</footer>

