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

Aplicación Web para uso y gestión de información clinica.

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

REQUERIMIENTOS
------------

*El requisito mínimo  de proyecto es que su servidor web sea compatible con [PHP](https://www.php.net/) 5.7.27

*[GIT](https://git-scm.com/)

*[docker](https://get.docker.com/) y [docker-composer](http://getcomposer.org/)

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
 
Editar el archivo `docker-compose.yml` con datos reales personal, por ejemplo:

```services:
   db:
     image: mysql:5.7.27
     environment:
        MYSQL_DATABASE: nombredeladb
        MYSQL_ROOT_PASSWORD: contradeusuario
```

```app:
    ports:
        - 8000:80
      environment:
        DB_DATABASE: nombredeladb
        DB_PASSWORD: contradeusuario
        DB_HOST: db
```
``` phpmyadmin:
         PMA_HOST: db
         PMA_USER: root
         PMA_PASSWORD: contradeusuario
         PMA_PORT: 3306
      ports:
```      
### Ejecucion de inicio :
Ejecutar y levantar el repositorio. 
 ```
   $ practica202010/ docker-compose up -d
 ``` 
Ejecutar por consola **start-project.sh** encontrado en la carpeta /bin.
Estos comando instalaran la estructura del proyecto yii2 en nuestro host. 
```
   $ TPFinal/bin/start-project.sh
 ``` 

Ejecutar por consola **first-start.sh** encontrado en la carpeta /bin.
Estos comandos actualizan el composer y corrige los permisos a carpetas importantes para la aplicación.
```
   $ TPFinal/bin/first-start.sh
``` 
 Acceder al sitio desde la url : **localhost:8000** - PhpMyAdmin : **localhost:8001**
 
 Usuario Prueba : **admin** pass: **123456**

``` 
 Acceder al phpMyAdmin desde la url :
PhpMyAdmin : **localhost:8001**
