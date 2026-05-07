<?php
/**
 * ============================================================================
 * ARCHIVO: eventos.php
 * DESCRIPCIÓN: Página principal que muestra el listado de todos los eventos
 *              registrados en la base de datos con su estado calculado.
 * ============================================================================
 */

/**
 * Configura la zona horaria a Paraguay (America/Asuncion)
 * Esto es necesario para calcular correctamente el estado de los eventos
 * (Finalizado/Pendiente) comparando con la fecha y hora actual.
 */
date_default_timezone_set('America/Asuncion');

/**
 * INCLUSIÓN DE ARCHIVOS DE LIBRERÍA:
 * - conexion.php: Contiene la clase Conex para conectarse a la base de datos MariaDB/MySQL
 *   Ubicación: lib/conexion.php
 * - evento.php: Contiene la clase Evento con métodos CRUD (getALL, getByID, insert, update, delete)
 *   Ubicación: lib/evento.php
 */
include "lib/conexion.php";  // Enlazado a: lib/conexion.php -> Clase Conex
include "lib/evento.php";    // Enlazado a: lib/evento.php -> Clase Evento

/**
 * CONEXIÓN A LA BASE DE DATOS:
 * Se instancia la clase Conex y se llama al método conectar()
 * que retorna un objeto mysqli para interactuar con la BD 'dw2_agenda'
 */
$db = new Conex();           // Crea instancia de la clase Conex (lib/conexion.php)
$con = $db->conectar();      // Ejecuta método conectar() -> retorna conexión mysqli

/**
 * OBTENCIÓN DE DATOS:
 * Se crea una instancia de la clase Evento pasándole la conexión
 * y se usa getALL() para obtener todos los eventos de la tabla 'eventos'
 * 
 * Método getALL() -> Enlazado a: lib/evento.php línea 8
 * Ejecuta: SELECT * FROM eventos;
 */
$evento = new Evento($con);  // Crea instancia de Evento con la conexión
$rs = $evento->getALL();     // Obtiene todos los eventos -> retorna mysqli_result

$nombre = "Clases de Informatica";  // Variable para mostrar en el título
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style0326.css">
    </head>
    <body>
        <h3>Bienvenido, elija su evento: <?php echo $nombre;?></h3>

        <table border="1">
            <tr>
                <td colspan="7" align="center">
                    <?php // num_rows devuelve la cantidad de filas de la consulta ?>
                    Cantidad total de eventos registrados: <?php echo $rs->num_rows;?> 
                </td>
            </tr>
            <tr>
                <th>ID</th>
                <th>Nombre Evento</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Lugar</th>
                <th>Estado</th>
                <td colspan="2">Acciones</td>
            </tr>
            <?php 
            // aqui el while extrae los datos como arrays asociativos y los guarda en la variable fila
            while ($fila = $rs->fetch_assoc()) { 
                // se establece una variable ahora donde recibira una hora y fecha del elemento datetime
                // PD: datetime trabajara con el horario local, gracias al elemento date_default_timezone_set
                $ahora = new DateTime();
                // se crea una variable donde se almacenara cada fecha y hora de los eventos
                $fechaEvento = new DateTime($fila['fecha'] . " " . $fila['hora']);
                /** se realiza una condicional donde se compara si la variable actual es menor a fecha evento
                 * si fechaevento es menor a ahora, significa que el evento finalizo pero si fechaevento
                 * es mayor, el evento esta en el estado pendiente 
                */
            if ($ahora > $fechaEvento) {
                $estadoCalculado = "<span style='color:red;'>Finalizado</span>";
            } else {
                $estadoCalculado = "<span style='color:green;'>Pendiente</span>";
            }
            ?>
            <tr>
                <td><?php echo $fila['id'];?></td>
                <td><?php echo $fila['titulo'];?></td>
                <td><?php echo $fila['fecha']; ?></td>
                <td><?php echo $fila['hora']; ?></td>
                <td><?php echo $fila['lugar']; ?></td>
                <td><?php echo $estadoCalculado; ?></td>
                <td>editar</td>
                <td>eliminar</td>
            </tr>
            <?php 
            } 
            ?>
        </table>
    </body>
</html>