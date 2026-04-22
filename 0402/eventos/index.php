<?php
// aqui se define la zona horaria para poder realizar la actividad del apartado estado
date_default_timezone_set('America/Asuncion');
// se incluye la conexion al archivo conexion
include "../lib/conexion.php";
// se instancia la clase conexion en una variable
$db = new Conex();
// se realiza la conexion
$con = $db->conectar();
// se realiza la consulta
$sql = "SELECT * FROM eventos ORDER BY fecha ASC;";
// se ejecuta la consulta
$rs = $con->query($sql);
$nombre = "Clases de Informatica";
?>
<?php include("/var/www/html/0402/parciales/templateStart.php"); ?>
        <h3>Bienvenido, elija su evento: <?php echo $nombre;?></h3>

        <table class="table table-bordered">
            <tr>
                <td colspan="6" align="center">
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
                <th>Editar</th>
                <th>Borrar</th>
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
                <td><a href=" editar.php?id=<?php echo $fila['id']; ?>">Editar</a></td>
                <td><a href=" borrar.php?id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Seguro que quieres borrar este evento?');">Borrar</a></td>

            </tr>
            <?php 
            } 
            ?>
        </table>
<?php include("/var/www/html/0402/parciales/templateEnd.php"); ?>
    