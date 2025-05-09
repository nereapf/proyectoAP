<x-layouts.layout>
    <x-layouts.header_inicio />
    <div class="flex-1 w-full max-w-5xl mx-auto py-20">
            <section class="mb-10">
                <h2 class="text-2xl font-bold text-blue-900 mb-2">¿Quienes somos?</h2>
                <p class="text-gray-700">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris auctor erat quis turpis porta. Vivamus laoreet id felis eu dictum.
                    Donec at commodo enim, non cursus erat. Etiam lacus gravida, dictum odio eu, tincidunt erat. Praesent volutpat, mi eu cursus
                    condimentum, nisl ex malesuada facilisis, erat urna dictum felis ac lorem. Pellentesque egestas, velit ac malesuada sagittis,
                    sem eros placerat lacus. Duis accumsan sapien est, vitae accumsan sapien dictum eget.
                </p>
            </section>

            <section class="mb-10">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">¿Qué hacemos?</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Card 1 -->
                    <div class="bg-gray-200 rounded-lg h-36 flex flex-col justify-end p-4">
                        <div>
                            <h3 class="font-semibold text-gray-800">Accesorios metal</h3>
                            <p class="text-sm text-gray-600">Mauris id molestie ipsum. Un lacus dolor, porttitor hendrerit odio euismod.</p>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-gray-200 rounded-lg h-36 flex flex-col justify-end p-4">
                        <div>
                            <h3 class="font-semibold text-gray-800">Espejos</h3>
                            <p class="text-sm text-gray-600">Aliquam sit dapibus odio. Donec sollicitudin elit id euismod tempus.</p>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-gray-200 rounded-lg h-36 flex flex-col justify-end p-4">
                        <div>
                            <h3 class="font-semibold text-gray-800">Iluminación led</h3>
                            <p class="text-sm text-gray-600">Mauris euismod ullamcorper lacus, eget aliquet lectus hendrerit placerat.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Ubicación y horarios -->
            <section class="mb-10">
                <h2 class="text-2xl font-bold text-blue-900 mb-2">Ubicación y horarios</h2>
                <p class="text-gray-700 mb-4">
                    Vestibulum malesuada egestas porta. Morbi a tempor elit. Etiam aliquam diam et erat ullamcorper facilisis. Quisque tincidunt
                    mauris nec turpis pharetra, id egestas lorem cursus. Etiam sit amet lacus euismod, sagittis erat eget, dictum augue.
                </p>
                <div class="flex flex-col md:flex-row md:space-x-8">
                    <div class="mb-4 md:mb-0">
                        <h4 class="font-semibold text-gray-800 mb-2">HORARIO</h4>
                        <ul class="text-gray-700 text-sm space-y-1">
                            <li>Lunes - lorem ipsum</li>
                            <li>Martes - lorem ipsum</li>
                            <li>Miércoles - lorem ipsum</li>
                            <li>Jueves - lorem ipsum</li>
                            <li>Viernes - lorem ipsum</li>
                        </ul>
                    </div>
                    <div class="flex-1">
                        <div class="bg-gray-200 rounded-lg h-20 w-full"></div>
                    </div>
                </div>
            </section>

            <!-- Botón catálogo -->
            <div class="flex justify-center mt-8">
                <a href=""
                   class="bg-blue-700 text-white font-semibold px-8 py-3 rounded hover:bg-blue-800 transition">
                    Acceder al catálogo
                </a>
            </div>
    </div>

</x-layouts.layout>
