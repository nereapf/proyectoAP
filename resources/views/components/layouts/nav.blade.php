<nav class="sticky top-0 z-50 bg-azulFondo border-b-4 border-t-4 border-azulBordes w-full">
    <ul class="flex justify-center space-x-12 py-3">
        <li>
            <a href="{{route("catalogos.index")}}"
               class="{{ request()->routeIs('catalogos.*') ? 'bg-azulMenuSeleccionado text-azulOscuro font-bold rounded-full px-3 py-1.5' : 'text-azulOscuro font-bold hover:bg-azulMenuSeleccionado rounded-full px-3 py-1.5' }}">
                Catálogo
            </a>
        </li>
        <li>
            <a href="{{route("proyectos.index")}}"
               class="{{ request()->routeIs('proyectos.*') ? 'bg-azulMenuSeleccionado text-azulOscuro font-bold rounded-full px-3 py-1.5' : 'text-azulOscuro font-bold hover:bg-azulMenuSeleccionado rounded-full px-3 py-1.5' }}">
                Proyectos
            </a>
        </li>
        <li>
            <a href="{{route("productos.index")}}"
               class="{{ request()->routeIs('productos.*') ? 'bg-azulMenuSeleccionado text-azulOscuro font-bold rounded-full px-3 py-1.5' : 'text-azulOscuro font-bold hover:bg-azulMenuSeleccionado rounded-full px-3 py-1.5' }}">
                Productos
            </a>
        </li>
        <li>
            <a href="{{route("gastos.index")}}"
               class="{{ request()->routeIs('gastos.*') ? 'bg-azulMenuSeleccionado text-azulOscuro font-bold rounded-full px-3 py-1.5' : 'text-azulOscuro font-bold hover:bg-azulMenuSeleccionado rounded-full px-3 py-1.5' }}">
                Gastos
            </a>
        </li>
        <li>
            <a href="{{route("materiales.index")}}"
               class="{{ request()->routeIs('materiales.*') ? 'bg-azulMenuSeleccionado text-azulOscuro font-bold rounded-full px-3 py-1.5' : 'text-azulOscuro font-bold hover:bg-azulMenuSeleccionado rounded-full px-3 py-1.5' }}">
                Materiales
            </a>
        </li>
    </ul>
</nav>
