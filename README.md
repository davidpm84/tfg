# Sistema gestor de vulnerabilidades y generación de informes automáticos como soporte a la realización de auditorías informáticas.
<h2>Trabajo de fin de grado de Ingeniería Informática en UNIR</h2>


Esta herramienta creada ha sido realizada con el fin de automatizar el trabajo de redacción y envío de un informe de auditoría o pentesting.

En esta herramienta podemos registrar en la base de datos las vulnerabilidades que encontremos en la auditoría, clasificándolas con OWASP Top 10, además, podemos poner la descripción y recomendación, así como el nivel de criticidad y esfuerzo para su corrección. Esta información nos ayudará luego a generar en el informe una tabla de criticidad como resumen global de las vulnerabilidades encontradas.

También podemos dar de alta múltiples empresas y crear activos asociados a cada empresa.
Finalmente, una vez tengamos todos los activos y las vulnerabilidades asociadas a los activos, podemos generar un informe completo de la auditoría.

Instalación manual
<ul>
<li>Primero debemos descargar un servidor Apache para alojar la herramienta, en mi caso uso MAMP (recomiendo seguir estos pasos): https://documentation.mamp.info/en/MAMP-Windows/Installation/index.html</li>
<li>Bajaremos el contenido de este repositorio y tendremos 3 carpetas y varios ficheros, uno de los ficheros es la base de datos con extensión .sql.</li>
<li>Una vez arranque el servidor iremos a c:/MAMP/htdocs y pegaremos todo el contenido descargado</li>
<li>Crearemos una base de datos asignando un nombre concreto e importaremos los datos del fichero basededatos.sql descargado</li>
<li>Para que la aplicación funcione tendremos que importar la base de datos, iremos a nuestro navegador y escribiremos "localhost/phpMyAdmin/". Crearemos una base de datos asignando un nombre concreto e importaremos los datos del fichero basededatos.sql descargado</li>
<li>A continuación, tienes el archivo de conexión de la base de datos en la carpeta raiz y se llama conexion.php, debes editar el usuario, contraseña y el nombre de la base de datos que hayas creado en el paso anterior.</li>
<li>Inicia sesión en la herramienta con un navegador en http://localhost introduciendo el nombre de usuario y la contraseña "demo"</li>
