<?php
// aqui se define la zona horaria para poder realizar la actividad del apartado estado
date_default_timezone_set('America/Asuncion');
// se incluye la conexion al archivo conexion
include "../lib/conexion.php";
include "../lib/evento.php";
// se instancia la clase conexion en una variable
$db = new Conex();
// se realiza la conexion
$con = $db->conectar();
// se realiza la consulta
//$sql = "SELECT * FROM eventos ORDER BY fecha ASC;";
// se ejecuta la consulta
//$rs = $con->query($sql);
$evento = new Evento($con);
$rs = $evento->getALL();
$nombre = "Clases de Informatica";
?>

<?php include_once("/var/www/html/0402/parciales/templateStart.php"); ?>
                <h1>Bienvenido a la aplicación</h1>

                  <?php if (isset($_GET['ok']) && $_GET['ok'] == 1) {
        echo "<span style='color: green;'>Evento insertado correctamente.</span><br><br>";
        } ?>
          <?php if (isset($_GET['ok']) && $_GET['ok'] == 2) {
        echo "<span style='color: green;'>Evento actualizado correctamente.</span><br><br>";
        } ?>
                  <?php if (isset($_GET['ok']) && $_GET['ok'] == 3) {
        echo "<span style='color: green;'>Evento eliminado correctamente.</span><br><br>";
    } ?>
          <?php if (isset($_GET['error']) && $_GET['error'] == 3) {
        echo "<span style='color: red;'>Error al eliminar el evento.</span><br><br>";
    } ?>

        <table class="table">
            <tr>
                <th colspan="7" align="center">
                    <?php // num_rows devuelve la cantidad de filas de la consulta ?>
                    Cantidad total de eventos registrados: <?php echo $rs->num_rows;?> 
                </th>
            </tr>
            <tr>
                <th>ID</th>
                <th>Nombre evento</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Lugar</th>
                <th>Estado</th>
                <th colspan="2"><a href="nuevo.php">Insertar</a></th>
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
                <th><?php echo $fila['id'];?></th>
                <th><?php echo $fila['titulo'];?></th>
                <th><?php echo $fila['fecha']; ?></th>
                <th><?php echo $fila['hora']; ?></th>
                <th><?php echo $fila['lugar']; ?></th>
                <th><?php echo $estadoCalculado; ?></th>
                <th><a href="editar.php?id=<?php echo $fila['id']; ?>">Editar</a> | <a href="borrar.php?id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Seguro que quieres borrar este evento?');">Borrar</a></th>
            </tr>
            <?php 
            } 
            ?>
        </table>
<?php include_once("/var/www/html/0402/parciales/templateEnd.php"); ?>
