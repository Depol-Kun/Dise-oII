Lógica de Conexión (lib/conexion.php)
Primeramente creamos una carpeta nombrada lib y en ella el archivo conexion.php donde se realiza lo 
siguiente:
Se establece una clase final con el fin de que esta no sea heredada ni reutilizada además de ese sector, 
el private indica que esas variables no serán modificadas fuera de esa clase a excepción de la variable 
pública "conexion", luego se crea un método conectar() el cual se encargará de establecer conexión 
entre PHP y MySQL, con el elemento $this le estamos ordenando enviar los datos de la clase al servidor 
mysqli, por último hacemos una comprobación de que esta conexión está funcionando y que no fue 
corrompida.

Lógica del Índice (index.php)
Antes de mostrar los datos, utilizamos la propiedad num_rows para realizar un conteo de la cantidad de 
filas que devolvió la base de datos; esto es fundamental para verificar si existen eventos registrados 
o si la tabla está vacía.
El siguiente paso es la creación de un archivo index.php donde importaremos la conexión con el archivo 
conexion.php, luego de ello atraemos la función de la clase en una variable nombrada "db", 
como paso siguiente, estableceremos un enlace llamando al método conectar a través de la variable "db".
Por consiguiente creamos una variable donde recibiremos el objeto que será almacenada en "rs", utilizando 
la sentencia "SELECT * FROM eventos"; esto permite atraer todos los títulos y 
valores de la tabla asegurando que los eventos se muestren ordenados cronológicamente por su fecha.
Luego realizamos la generación dinámica de la tabla: a través de un while guardaremos de manera repetitiva
cada array asociativo (que busca el valor por su título como "hora" y no por su índice) en una variable 
llamada "fila". Dentro de este bucle, implementamos la lógica para la columna Estado, comparando la fecha
del evento con la fecha actual para determinar si el evento está "Pendiente" o "Finalizado". 
Gracias a esto, los datos se organizan automáticamente en celdas HTML, 
mostrando la información completa y actualizada de la base de datos.