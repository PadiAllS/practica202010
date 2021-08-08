<p align="center">
    <a href="https://www.uncoma.edu.ar" target="_blank">
        <img src="https://www.uncoma.edu.ar/wp-content/uploads/2018/04/LOGOUNC-e1522858761795.png" height="100px">
    </a>
    <h2 align="center">Tecnicatura Universitaria en Desarrollo Web</h2>
    <h1 align="center">Trabajo Práctico Final</h1>
    <br>
</p>


Descrición del proyecto:
-------------------

Aplicación Web para uso y gestión de información de turnos e historias clinicas.

Estructura de directorios
-------------------

      bin/                contiene los scripts para la instalacion y configuracion de la Aplicacion
      config/             contiene configuraciones de la aplicación
      controllers/        contiene los controladores y clases web
      models/             contiene los modelos de las clases
      modules/            contiene los modulos,controladores,modelos de la API
      runtime/            contiene archivos generados durante la ejecucion
      vendor/             contiene packetes dependientes
      views/              contiene las vistas de aplicacion Web


Instalación
------------
Clonar el repositorio de github
 ```
   $ git clone https://github.com/PadiAllS/practica202010.git
 ``` 
Renombrar el archivo **docker-compose-dist.yml** por **docker-compose.yml**
-Desde consola
 ```
   $ cp docker-compose.dist.yml docker-compose.yml
 ```   
     
### Ejecucion de inicio :
Ejecutar y levantar el repositorio. 
 ```
   $ practica202010/ docker-compose up -d
 ``` 

Ejecutar por consola **first-start.sh** encontrado en la carpeta /bin.
Estos comandos actualizan el composer y corrige los permisos a carpetas importantes para la aplicación. También ejecutan las migraciones de las tablas de la base de datos.
```
   $ sh /bin/first_start.sh
``` 
 Acceder al sitio desde la url : **localhost:8000** - 
 Usuario: **admin** pass: **123456**

``` 
 Acceder al phpMyAdmin desde la url :
**localhost:8001**

