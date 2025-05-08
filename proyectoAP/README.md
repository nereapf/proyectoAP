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

## Inicio de sesión y registro de usuarios
En la ruta */resources/views/auth* se debe acceder al archivo de login para adquirir el formulario 
para realizar el inicio de sesión.
Este formulario puede ser editado para tener visualmente el formulario a gusto del usuario.

**IMPLEMENTACIÓN EN EL CÓDIGO**
Para realizar esto, en el enlace del boton ubicado en el footer se añade la ruta
de este archivo de la siguiente forma: href="{{route("login")}}".

Hay que tener en cuenta también que al realizar el inicio de sesión nos rediriga a la
página inicial del administrador, por lo que esto se conseguirá desde el controlador de la 
autenticación de usuario ubicado en *app/http/Controllers/auth/AuthenticatedSessionController.php*

En este caso se crea un solo usuario administrador con *php artisan tinker* y ejecutando lo siguiente:
use App\Models\User;
User::create([]);
Con los campos:
- nombre
- email
- bcrypt(contraseña)
Esto es creado por terminal ya que si se crea en la base de datos salta error ya que no está encriptada la
contrseña con bycript.


    




AÑADIR JSON EN TABLA PROYECTOS PARA VER TODAS LAS FOTOS DE TODOS LOS PRODUCTOS
