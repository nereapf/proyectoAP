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

Además de esto, al acceder con el inicio de sesión, queremos que la vista sea difernte y editable por lo que
para cambiar la ruta donde se redirigirá una vez se haya logeado el usuario se hace desde 
*AuthenticatedSessionController.php* en el store.

## Pestaña y favicon
Esto, sirve para el efecto visual ante el usario que accede a la web.
FAVICON: Para esto, en la carpeta *public* con el nombre *favicon.ico* se añade el icono y luego en
el layout se añade en la etiqueta head de la siguiente forma:
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
NOMBRE DE LAS PESTAÑAS: Simplemente añadiendo la etiqueta *title* en el header de los blade de las 
difernetes páginas para que cada una se llame de difernete manera, aunque en este caso se ha añadido
el titulo *Accesorios Pellés* al layout para que a la hora de crear una nueva página si no se le pone un título
y utiliza esa "plantilla" tenga un nombre general.

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
5. **CREAR** - Para hacer esto, se crea tanto el archivo create, como la funcion
   create y store del controlador.
   Para que la función *store* funcine también debemos configrar el archivo *StoreRequest.php* para
   introducir los campos a la hora de crear el proyecto. Además también se podrá tanto autorizar los permisos
   como añadir en el archivo una función para poder mostrar los mensajes de error cuando un campo sea erróneo
   a la hora de crearlo.
6.  **EDITAR** - Para ello primero de todo creamos en el index (dentro de la tabla) un
    botón para poder editar específicamente uno.
    Además, en el controler llamaremos a las funiones de edit y update para editar y actualizar la tabla, y
    crearemos en la carpeta el *edit.blade.php*, donde se creará un formulario para poder cambiar
    los datos. Junto a esto para que la funcion update funcione, se debe configurar el archivo
    *UpdateRequest.php* para que al igual que en el store, introduzca los datos, cree los mensajes de
    error para los campos que sean erróneos y autorice los permisos.
- Junto a la actualización, implementaremos una confirmación antes de realizar la acción con
  la librería de sewwtalert.
    - Instalaremos la librería (npm install sweetalert --save)
    - Incluimos la libreria en resources/js/app.js
    - Acceder a *edit.blade.php* para llamar a la funcion en el formulario y cuando haga click al boton de
      "Guardar" pida la confirmación.
7. **ELIMINAR** - Para ello primero como al editar, creamos en el index (dentro de la tabla) un
   botón para poder eliminar específicamente uno. Para borrarlo simplemente se crea un
   formulario donde se ubica el boton para que cuando haga click confirme si se quiere borrar mediante una
   funcion de javascript y si esta se confirma se elimina de la base de datos y la tabla a través del id.
   Además, necesitaremos en el controler a la funcion destroy para poder eliminarlo.
- Al igual que en la actualización, en la eliminación, implementaremos una confirmación
  antes de realizar la acción con la librería de sewwtalert.
- Como la librería ya esta intalada simplemente habría que crear el codigo de js para el alert de
  confirmación e implementarlo en la tabla ubicada en el index.
8. Añadir la ruta para que al pulsar el boton correspondiente del nav te redirija a los index correspondientes
- Implementar el href a los botones para redirigirlos (nav.blade.php)
9. Junto a esto se implementarán también unos mensajes, que se mostrarán cuando se haya realizado una de
   las acciones, esto se realiza a través del controller almacenado los valores y el mensaje, y llamandole
   desde el index para mostrarlo además de aplicarle una transición de desaparición con js.

## Otras cosas dentro de la WEB
### Automatización
Se crearán 2 seeders, que se utilizarán para crear de forma automatica tanto el catálogo como el usuario de administrador.
- *CatalogoSeeder*: Creación de un catálogo con nombre PRINCIPAL para añadir todos los productos a ese
catálogo que será único.
- *AdministradorSeeder*: Creación de un usuario Administrador con su respectivo email, nombre y contraseña
hasheada para poder guardarla en la base de datos.
Luego estos, se añaden al DataBaseSeeder para automatizar la utilización de los mismos al realizar
*php artisan migrate:fresh* 

### Mapa con ubicación
Para esto, hay que descargarse la librería de Leaflet y luego ubicar este link en el haeder de la página
donde se va a visualizar el mapa: *<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>*
Junto a esto, se crea un DIV donde se ubicará el mapa y con javascript creando las variables de las
coordeandas, el zoom a elegir para mostrarlo, el mapa en sí y el simbolo de ubicación, se insertará el mapa 
llamando al div donde se ubicará.

### Mostrar los checkbox de un formulario marcados a la hora de editar si ya existen
En proyectos, a la hora de editar el mismo, se puede ver que existe una serie de  checkbox para marcar y
añadir dichos productos al proyecto que se está editando.
Pero se requiere que a la hora de editar un proyecto ya salgan marcados los productos ya existentes en ese proyecto.
En el controlador del proyecto se deben recoger los productos ya seleccionados:
- Creando una variable para ello donde se recoge del proyecto a editar los id de cada producto y lo convierte 
en un array *proyecto->productos()->pluck('productos.id')->toArray()*
- Junto a esto en el blade de los checkbox, en el propio input se crea una condicion para que si el id de ese
producto esta en el array de los productos ya existentes lo marque como *checked*

### Catálogo público y valoraciones
Para el catálogo público mostramos todos los productos que esten añadidos al único catalogo existente
que es "principal" y para poder ver cada producto individualmente con sus características se crea
*show.blade.php* en productos.
En este archivo, se mostrarán todos los datos de dicho producto, además de la media de valoraciones
que tiene el mismo y un apartado para que se pueda valorar ese prooducto a su vez.

*VALORACIONES*
Para esto, hay que conseguir almacenar las mismas a través de un formulario e ir haciendo una media 
cada vez que se añada una nueva valoracion a la tabla en la base de datos para poder obtener una media
actualizada de los valores introducidos por los diferentes usuarios.
1. Creación de migración, controladores y modelo con sus respectivas relaciones al igual que las demás tablas
2. Formulario para valorar un producto, el cual se mostrará en el archivo *show* de productos donde el mismo 
realizará el guardado de la valroacion en *valoraciones.store* a través del id del producto
3. Ruta para poder mostrar las valoraciones y acceder a ellas
4. Para pintar las valoraciones...
 - Media de valoraciones: Se recoge un redondeo de la media de todas las valoraciones que existan en
    la base de datos y se pintan las estrellas de amarillo que sean iguales o menores a esa media, además
    de añadir un contador de las valoraciones que se han hedcho a ese producto en específico
 - Formulario valoración: El cual se guardará en el método store de la valoración con el id de dicho producto
    para poder realizar la relacción.
    Este formulario será funcional gracias a javascript donde se creará un listener y se realizará cuando el
    DOM esté cargado, donde selecciona las estrellas en un array y crea una variable para guardar la valoracion.
    Junto a esto, el evento para que en cada estrella exista un click donde poder incrementar el valor de la estrella
    haciendo asi que se guarde el valor y se pinten las estrellas con la funcion especificada.

### Buscador en las diferentes secciones
En el index donde se ubican la tablas se añade el input para introducir el texto que se desea buscar
y junto a eso en ese mismo index se implementa un addEventListener de javascript para que recoga el
texto introducido en el input y ejecute una funcion para recoger todas las filas de la tabla e ir comparandolas 
con el texto introducido cada vez que se escribe en el input, para mostrarlo con display o por el 
contrario no mostrarlos.

### API comparación de precios con mercado (Google Cloud)
1. Primero se crea un proyecto en google cloud para poder generar una clave API. Esto se hace habilitando la api
llamada *Custom Search API* y allí se crea en la seccion Credenciales una clave de API.
2. Luego, en *programmablesearchengine.google.com/controlpanel/all* añadir un buscador para que busque en google 
shopping.
3. También se debe instalar Guzzle que es una librería para realizar peticiones http a APIs.
4. Una vez todo esto, en el proyecto de laravel, se crea la ruta donde se ubicará y el controlador para manejar
la comparación.
5. Finalmente es implementarlo en el blade de productos como un formulario con un botón que nos lleve al blade
donde se visualizan los resultados, recogiendo en un blade la vista con la imagen, enlace, titulo y descripción
de todos los productos que se encuentren con ese nombre en la store de google.
