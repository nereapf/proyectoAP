# CREACIÓN APP WEB
## Cambios iniciales
1. Se inicializa el proyecto de laravel 
2. Añadir el archivo docker-compose.yaml para poder orquestar los contenedores de docker
   y poder levantar el proyecto
3. Cambiar la configuración del *.env* para que los datos de la base de datos en el
   propio equipo se relaccionen con los datos del docker
4. Ejecutar las migraciones, donde en cada una se crean los campos que existirán en las respectivas 
tablas de la base de datos.
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

## Configuracion CRUD
### Base de datos 
Una vez las migraciones realizadas al principio se han de crear los modelos de las mismas para poder
hacer las relacciones entre sí.
Donde en cada funcion de cada modelo se pueden recoger una serie de datos para relacionarlos.

Ahora se crean los controllers *php artisan make:controller nombre --resource* de cada sección para
poder implementar los CRUD de cada uno.

### Implementacion CRUD 
1. Crear las rutas del crud para el controlador en *routes/web.php* para que solo los
   usuarios autenticados puedan acceder.
- Route::resource('materiales', MaterialController::class)->middleware('auth');
2. Creación de carpetas en *resources/views* para poder crear los archivos
   dedicados a cada sección, como la creación del formularios para añadir nuevos, editarlos, etc.
   En esta ocasión se crean las carpetas:
   - Producto
   - Material
   - Proyecto
   - Gasto
   - Catalogo
3. En cada carpeta se deben crear unos archivos para mostrar las tablas (index),
   crear los mismos (create), editar existentes (edit), dependiendo de las funciones de cada uno.
- Create: Creación de un formulario que recoge los datos y llama al store del controlador
  para poder guardarlos en la base de datos.
- Index: Tabla donde se muestran todos los proyectos donde se podrán visualizar, editar, borrar y añadir.
4. Acceder al controlador para hacer que las funciones devuelvan la vista de estos archivos creados
   anteriormente.
   *Index*: Recoger de la base de datos los campos y las filas de la tabla para luego mostrarla.
   *Create*: Devolver la vista de los archivos de proyectos.
   *Store*: Guarda los datos en la base de datos y redirecciona de vuelta al index con la tabla.
   *Edit*: Devuelve el formulario de manera que puedas editar el proyecto especificado.
   *Update*: Actualiza los datos del proyecto y guarda los nuevos datos en la base de datos.
   *Destroy*: Elimina el proyecto seleccionado de la base de datos.
5. **CREAR UN NUEVO PROYECTO** - Para hacer esto, se crea tanto el archivo create, como la funcion
   create y store del controlador.
   Para que la función *store* funcine también debemos configrar el archivo *StoreProyectoRequest.php* para
   introducir los campos a la hora de crear el proyecto. Además también se podrá tanto autorizar los permisos
   como añadir en el archivo una función para poder mostrar los mensajes de error cuando un campo sea erróneo
   a la hora de crearlo.
6.  **EDITAR UN PROYECTO** - Para ello primero de todo creamos en el index (dentro de la tabla) un
    botón para poder editar específicamente uno de los proyectos.
    Además, en el controler llamaremos a las funiones de edit y update para editar y actualizar la tabla, y
    crearemos en la carpeta proyectos el *edit.blade.php*, donde se creará un formulario para poder cambiar
    los datos. Junto a esto para que la funcion update funcione, se debe configurar el archivo
    *UpdateProyectoRequest.php* para que al igual que en el store, introduzca los datos, cree los mensajes de
    error para los campos que sean erróneos y autorice los permisos.
- Junto a la actualización de un proyecto implementaremos una confirmación antes de realizar la acción con
  la librería de sewwtalert.
    - Instalaremos la librería (npm install sweetalert --save)
    - Incluimos la libreria en app.js
    - Acceder a *edit.blade.php* para llamar a la funcion en el formulario y cuando haga click al boton de
      "Guardar" pida la confirmación.
7. **ELIMINAR UN PROYECTO** - Para ello primero como al editar, creamos en el index (dentro de la tabla) un
   botón para poder eliminar específicamente uno de los proyectos. Para borrarlo simplemente se crea un
   formulario donde se ubica el boton para que cuando haga click confirme si se quiere borrar mediate una
   funcion de javascript y si esta se confirma se elimina de la base de datos y la tabla a través del id.
   Además, necesitaremos en el controler a la funcion destroy para poder eliminarlo.
- Al igual que en la actualización, en la eliminación de un proyecto implementaremos una confirmación
  antes de realizar la acción con la librería de sewwtalert.
    - Como la librería ya esta intalada simplemente habría que crear el codigo de js para el alert de
      confirmación e implementarlo en la tabla ubicada en el index.
8. Añadir la ruta para que al pulsar el boton *proyectos* del nav te redirija a proyectos.index
- Implementar el href a los botones para redirigirlos (nav.blade.php)
9. Junto a esto se implementarán también unos mensajes, que se mostrarán cuando se haya realizado una de
   las acciones, esto se realiza a través del controller almacenado los valores y el mensaje, y llamandole
   desde el index para mostrarlo además de aplicarle una transición de desaparición con js.
    




AÑADIR JSON EN TABLA PROYECTOS PARA VER TODAS LAS FOTOS DE TODOS LOS PRODUCTOS
