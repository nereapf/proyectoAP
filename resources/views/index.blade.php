<x-layouts.layout>
    <x-layouts.header_inicio />
    <div class="flex-1 w-full max-w-5xl mx-auto pt-20">
        <section class="grid grid-cols-1 md:grid-cols-2 mb-10 items-end">
            <div>
                <h2 class="text-2xl font-bold text-blue-900 mb-2">¿Quienes somos?</h2>
                <p class="text-gray-700">
                    Accesorios Pellés, una empresa ubicada en El Burgo de Ebro (Zaragoza) con una
                    sólida trayectoria en el sector industrial.
                    Nos especializamos en la fabricación y personalización de productos metálicos,
                    además de ofrecer servicios de iluminación LED, grabado láser, pintura en máquina y
                    otros acabados técnicos.<br>
                    Desde nuestros inicios, hemos apostado por la calidad, la atención al detalle y el trato cercano
                    con el cliente. Nuestro equipo combina la experiencia artesanal con tecnologías innovadoras
                    para ofrecer soluciones a medida que se adaptan a las necesidades de cada proyecto.
                </p>
            </div>
            <img src="{{ asset('images/empresa.JPG') }}" alt="Foto de la empresa" class="max-h-64 ml-32">
        </section>
        <section class="mb-10">
            <h2 class="text-2xl font-bold text-blue-900 mb-4">¿Qué hacemos?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-azulFondo rounded-lg p-4">
                    <div>
                        <img src="{{ asset('images/accMetal.jpg') }}" alt="metal" class="w-64 h-48 m-4 rounded">
                        <h3 class="font-semibold text-gray-800">Accesorios metal</h3>
                        <p class="text-sm text-gray-600"> Profesionales del metal. Gran exclusividad de piezas a medida. Fabricamos en metal lo que usted necesite, con nuestro diseño o el suyo propio.</p>
                    </div>
                </div>
                <div class="bg-azulFondo rounded-lg p-4">
                    <div>
                        <img src="{{ asset('images/luzLed.png') }}" alt="led" class="w-64 h-48 m-4 rounded">
                        <h3 class="font-semibold text-gray-800">Iluminación led</h3>
                        <p class="text-sm text-gray-600">En la sección led se trabaja principalmente iluminación para el baño. Aunque también  para cocina, mueble y decoración, haciendo las salas o muebles más llamativos y únicos.</p>
                    </div>
                </div>
                <div class="bg-azulFondo rounded-lg p-4">
                    <div>
                        <img src="{{ asset('images/espejoAumento.jpg') }}" alt="baño y espejo" class="w-64 h-48 m-4 rounded">
                        <h3 class="font-semibold text-gray-800">Baños y espejos</h3>
                        <p class="text-sm text-gray-600">Fabricamos todo tipo de accesorios, complementos y herrejes para  el mueble de baño y baño en general. Además de espejos para los mismos.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl font-bold text-blue-900 mb-2">Ubicación y horarios</h2>
            <p class="text-gray-700 mb-4">
                Nos ubicamos en el Polígono Industrial La Noria, calle Río Ara en las naves 2 y 3 de El Burgo de Ebro (Zaragoza).
            </p>
            <div class="flex flex-col md:flex-row md:space-x-8">
                <div class="mb-4 md:mb-0">
                    <h4 class="font-semibold text-gray-800 mb-2">HORARIO</h4>
                    <ul class="text-gray-700 text-sm space-y-1">
                        <li>Lunes - De 7 a 15 horas</li>
                        <li>Martes - De 7 a 15 horas</li>
                        <li>Miércoles - De 7 a 15 horas</li>
                        <li>Jueves - De 7 a 15 horas</li>
                        <li>Viernes - De 7 a 15 horas</li>
                    </ul>
                </div>
                <div id="mapa" class="flex-1">
                </div>
            </div>
        </section>

        <div class="flex justify-center mt-8">
            <a href="{{ route('catalogo.publico') }}"
               class="bg-azulBoton text-white font-semibold px-8 py-3 rounded-xl hover:bg-azulOscuro transition">
                Acceder al catálogo
            </a>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        let latitud = 41.5805;
        let longitud = -0.7481;

        let mapa = L.map('mapa').setView([latitud, longitud], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(mapa);

        L.marker([latitud, longitud]).addTo(mapa)
            .openPopup();
    </script>
</x-layouts.layout>
