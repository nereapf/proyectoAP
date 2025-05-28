<x-layouts.layout>
    <x-layouts.header_cat_prod />
    <div class="max-w-4xl mx-auto p-6 mt-10">
        <div>
            @if(session('mensaje'))
                <div id="mensaje" class="fixed top-6 left-1/2 -translate-x-1/2 bg-green-100 text-green-800 px-6 py-3 rounded-xl shadow-lg z-50 transition-opacity">
                    {{ session('mensaje') }}
                </div>
            @endif

            <h1 class="text-3xl font-extrabold mb-5">{{ $producto->nombre }}</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <div>
                    <img src="{{ asset('storage/' . $producto->foto) }}" alt="{{ $producto->nombre }}" class="h-full w-full object-cover rounded-lg">
                </div>

                <div class="space-y-4 pt-3">
                    <div>
                        <p><b>Precio:</b> {{$producto->precio, 2}}€</p>
                    </div>

                    <div class="mb-6">
                        <p><b>Media valoraciones:</b></p>
                        <div class="flex items-center">
                            @php
                                $media = $producto->valoraciones->avg('valor') ?? 0;
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-6 h-6 {{ $i <= $media ? 'text-amarilloEstrellas' : 'text-grisEstrellas' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                            <span class="ml-2 text-gray-600">({{ $producto->valoraciones->count() }} valoraciones)</span>
                        </div>
                    </div>

                    <div>
                        <p><b>Colores del producto:</b> {{$producto->color}}</p>
                    </div>

                    <div>
                        <p><b>Medidas:</b> {{$producto->medidas}}</p>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('valoraciones.store', $producto->id) }}" class="border-t-2 pt-4 mt-8" id="formularioValoracion">
                @csrf
                <div class="flex items-center gap-4 mb-4">
                    <p class="font-bold mb-2 text-md">CALIFICAR PRODUCTO:</p>
                    <div class="flex items-center mb-2" id="estrellas">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button" class="estrella bg-none border-none p-0 m-0">
                                <svg class="w-9 h-9 text-grisEstrellas transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </button>
                        @endfor
                    </div>
                    <input type="hidden" name="valor" id="valor" required>
                    <button type="submit" class="bg-azulBoton text-white px-2 py-1 ml-80 rounded hover:opacity-80">
                        Enviar valoración
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let estrellas = Array.from(document.getElementsByClassName('estrella'));
            let inputValor = document.getElementById('valor');
            let valorSeleccionado = 0;

            estrellas.forEach((estrella, valor) => {
                estrella.addEventListener('click', () => {
                    valorSeleccionado = valor + 1;
                    inputValor.value = valorSeleccionado;
                    estrellasAmarillas(valorSeleccionado);
                });
            });

            function estrellasAmarillas(num) {
                estrellas.forEach((estrella, i) => {
                    let svg = estrella.querySelector('svg');
                    if (i < num) {
                        svg.classList.remove('text-grisEstrellas');
                        svg.classList.add('text-amarilloEstrellas');
                    } else {
                        svg.classList.remove('text-amarilloEstrellas');
                        svg.classList.add('text-grisEstrellas');
                    }
                });
            }
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
