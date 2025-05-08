# CREACIÓN APP WEB
## Cambios iniciales
1. Se inicializa el proyecto de laravel 
2. Añadir el archivo docker-compose.yaml para poder orquestar los contenedores de docker
   y poder levantar el proyecto
3. Cambiar la configuración del *.env* para que los datos de la base de datos en el
   propio equipo se relaccionen con los datos del docker
4. Ejecutar las migraciones 
5. Instalacion de daisyui primero haciendo un update del composer para luego instalarlo con el
   comando **npm i -D daisyui@latest** y luego añadirlo al tailwind como plugin

## Creación paginas inicales y plantillas
Para crear la base de este proyecto principalmente en *resources/views/components/layouts*
se ha de crear los layouts:
- Layout principal (layout.blade.php) -> El cual recoge el css y los demás layouts para
  mostrarlos, añadiendo ahí también {{$slot}} para mostrar el contenido principal del index.
- Diferentes layouts de cabecera (header.blade.php) -> Cabeceras diferentes dependiendo de 
  la página en la que se encuetre.
- Layout manu (nav.blade.php) -> Este, muestra un pequeño menú para navegar por la web.
- Layout de pie de página (footer.blade.php) -> Un pie de página para darle un cierre visual
  a la página donde se ubicará un botón para iniciar sesión como administrador, el cual cambiará
  dependiendo si has iniciado sesión o eres usuario estandar.

**Junto a esto...**
Situado en *resources/views* se encuentra el index.blade.php, el cual se ingresará la información 
desdeada a mostrar en la página inicial, ya que se configura para que esta página aparezca por defecto. 
Esto se consigue mediante el archivo *web.php* añadiendo la ruta deseada.

## Creacion de estilos con tailwind
Para tener una pagina visual y colorida como por ejemplo la cabecera, footer y demás podemos
gracias a tailwind, crear colores personalizados para luego poder aplicarlos con clases a
los elementos que necesitemos.
Esto se consigue en el archivo de tailwind.config.js:
- Creando al igual que el tipo de texto, la configuracion 'colors'

AÑADIR JSON EN TABLA PROYECTOS PARA VER TODAS LAS FOTOS DE TODOS LOS PRODUCTOS
