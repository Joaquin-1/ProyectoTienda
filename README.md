<p align="center"><a href="https://laravel.com" target="_blank"><img src="/public/img/logo.png" width="400"></a></p>

- BetweenFilms
- Joaquin Monge Jiménez
- Curso 2023/2024


## Descripcion general del proyecto

Between Films es una aplicación donde usuarios registrados podrán comprar peliculas desde casa. Cada
usuario tendrá su propio perfil que podrá modificar, además contará con una pestaña de atención
al cliente con preguntas/respuestas y acceso a ver valoraciones de cada producto hechas por los mismos clientes, 
en donde aparecerán reseñas de x pelicula por parte de la gente que ya haya visto dicha pelicula.

## Funcionalidad principal de la aplicacion

El objetivo principal es crear un "videoclub moderno", una página web desde la que se pueda
comprar peliculas y además facilitar la busqueda a los usuarios para que puedan buscar peliculas por categoría, 
entre otros, además de dar su opinión y hablar sobre este tema. Además, el usuario podrá personalizar su perfil
para mostrar datos que crea correspondiente y contara con una pestaña "F&Q" en la que podrán encontrar informacion
de la web.

## Objetivos generales

    Objetivo: "Gestión de usuarios", "Gestión de compra de pelicula".

    Casos de uso:

        Invitado : "registrarse", "ver pagina de inicio".

        Usuarios: "iniciar sesion", "cerrar sesion", "editar perfil","buscar productos", "ver productos", "comentar productos" "responder comentarios", "comprar productos", 
                    "hacer preguntas al admin", "ver carrito", "establecer su dirección", "editar su dirección", "ver pedidos pendientes", "ver historial de compra".

        Administrador: "iniciar sesión", "cerrar sesión", "editar perfil", "ver usuarios", "eliminar un usuario (junto a toda información vinculada a él)", ver productos, "añadir comentarios", 
        "responder comentarios", "añadir una pelicula", "eliminar una pelicula", "modificar datos de una pelicula", "añadir nuevas imagenes a una pelicula", "responder preguntas de clientes", 
        "ver todos los productos pendiente de envio", "ver los datos del usuario en el producto que ha comprado", "modificar el estado (Pendiente de envio, enviado, completo) de un producto", 
        "ver el historial de productos vendidos".



## Elemento de innovación

Implementar un mapa con la ubicación de la tienda, utilizar la libreria "Livewire", pago a traves de la API "Stripe"




## Pasos para crear/iniciar un proyecto en laravel

1. Creas usuario y base de datos para el proyecto.
2. Creas el proyecto (composer create-project laravel/laravel mi-proyecto-laravel) en la terminal.
3. Modificas el .env
4. Pones npm run watch -d y php artisan serve en terminales distintas.
5. Creas modelo (migracion, modelo, controlador) para cada tabla, y solo migraciones para tablas pivote.
6. Rellenas las migraciones, despues el modelo y el CRUD para mas adelante.
7. Ejecutas la migracion para enviarla a la base de datos creada.
8. Añadimos en la ruta (web.php) la ruta de la tabla con la que se vaya a realizar el CRUD inicial.
   Route::resource('Producto', ProductoController::class)
9. Rellenamos el CRUD.
10.Creamos una carpeta con el nombre de la tabla que tiene el CRUD (minuscula/plural), y dentro metemos
   index.blade.php/create.blade.php/edit.blade.php.
11.Darle permisos del CRUD solo al admin: 1º Cambio (/routes/web.php) | 2º Cambio (/app/Providers/AuthServiceProvider.php)
   3º Cambio (/app/Http/Request/StoreMonosgrafiaRequest.php && UpdateMonosgrafiaRequest.php)


///////PARA PROYECTOS CLONADOS////////

1. Git clone al repositorio donde tienes el protecto
2. Crear una base de datos y un usuario vacio.
3. Run composer install.
4. Run cp .env.example .env.
5. Completas el .env
6. Run php artisan key:generate.
7. npm install
8. Run php artisan migrate.
9. npm run watch -d
10. Run php artisan serve.

//1-POSTGRES//

//1.1 Conexión a base de datos
// OPCIONES-> -h = ip | -U = usuario | -d = base de datos  

//Modo postgres
sudo -u postgres psql -d prueba SE USA ESTE PARA PODER MODIFICAR LA BASE DE DATOS

//Modo usuario normal
psql -h localhost -U prueba -d prueba

*************************************************************
//1.2 Creación Usuario prueba

//Desde terminal
sudo -u postgres createuser -P prueba

//Desde postgres
CREATE USER prueba;

*************************************************************
//1.3 Creación Base de datos

//Desde terminal
sudo -u postgres createdb prueba

// Desde postgres
CREATE DATABASE prueba;
// Opción de dar propietario a un usuario
CREATE DATABASE prueba WITH OWNER usuario;
ALTER DATABASE bdname OWNER TO usuario; 

*************************************************************
//1.4 Comandos posgres

\?		//Ayuda postgres
\?		//Ayuda comandos pgsql
\l   		//Listado de base de datos
\d   		//Listado de tablas y secuencias
\dt		//Listado de tablas
\du		//Listado de usuarios
\d+ nombretabla	//Muestra información detallada de una tabla

*************************************************************
*************************************************************
//2- LARAVEL
//2.1 Crear proyecto nuevo Laravel (Con Tailwind)

composer create-project laravel/laravel nombreProyecto //Crear el proyecto
cd nombreProyecto    //Entras en la carpeta del proyecto

composer require laravel/breeze // Te hace falta para instalar breeze y te instala el vendor
php artisan breeze:install // Instala el breeze

npm install          //Te crea la carpeta Node_Modules

npm run dev       //Comenzar el build process ejecutando (Necesario para que funcione)
npm run watch -d  //Build process automático (Para los cambios de estilos en la vista)


*************************************************************
//2.2 Fichero .env

//Copiar .env.example
cp .env.example .env

//Editar fichero .env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=tubasededatos
DB_USERNAME=tuusuario
DB_PASSWORD=tucontraseña

//Generar la clave para .env (SOLO CUANDO ES UN PROYECTO CLONADO)
php artisan key:generate

//3  CREAR MODELOS,MIGRACION y CONTROLADOR

php artisan make:model -a Monografia (Mayuscula/Singular) Te crea migracion, modelo y controlador.

Nota: Si es para tablas que no tienen identificacion propia (tablas con claves ajenas), no es necesario crear un modelo, ya que solo necesitan una migración. 
Se crearía con (php artisan make:migration create_nombreMigracion_table).

EJEMPLO DE MIGRACION DE UNION CON CLAVES AJENAS
	public function up()
    {
        Schema::create('articulo_monografia', function (Blueprint $table) {
            $table->foreignId('articulo_id')->constrained('articulos');
            $table->foreignId('monografia_id')->constrained('monografias');
            $table->primary(['articulo_id', 'monografia_id']);
        });
    }

//3.1 COMANDOS PARA LAS MIGRACIONES
//Crear migraciones
php artisan make:migration nombreMigracion

//Ver estado de las migraciones
php artisan migrate:status

//Borrar última migración
php artisan migrate:rollback

//Borrar todas las migraciones
php artisan migrate:reset

//Borrar todas las tablas y migrar
php artisan migrate:fresh

//Ejecutar la migración
php artisan migrate






