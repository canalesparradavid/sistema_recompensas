# Sistema de Recompensas
Este proyecto consiste en una página web en la que el ususario puede hacer un login
en el que podrá ver una tabla con un sistema de puntuación en el que hay tareas y recompensas.
Para que un usuario pueda conseguir puntos, este debe realizar tareas.

Con dichos puntos, el usuraio podrá canjearlas en recompensas; esta acción restará el importe en puntos de la recompensa.

Por otro lado habrá un apartado en el que un administrador se encargará de validar que las tareas que ha indicado un usuario que ha realizad esten realmente realizadas o no.

## Puesta a punto de la página
Esta pagina web necesita de un servidor con APACHE, PHP y una conexión con MYSQL para funcionar. Para el desarrollo he usado [USBWEBSERVER](https://usbwebserver.yura.mk.ua) pero usted es libre de usar otro cliente con tal de que contenga los elementos mencionados anteriormente.

Para crear la base de datos puede usar el script que se facilita [aquí](script.sql) y ejecutar las sentecias SQL sobre la base de datos.

Para los ficheros .php es tan facil como copiar todo el directorio sobre el directorio raiz del servidor APACHE.

## Credenciales administrador
Por defecto la base de datos viene con un usuario de administración al que puede acceder desde la pagina de loggin con los siguientes datos:

    Usurario: admin
    Contraseña: admin
