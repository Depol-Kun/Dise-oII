<?php
date_default_timezone_set('America/Asuncion');
include "../lib/conexion.php";
include "../lib/evento.php";

$db = new Conex();
$con = $db->conectar();
$evento = new Evento($con);
$rs = $evento->getALL();
$nombre = "Clases de Informatica";
?>
<?php include(__DIR__ . "/../parciales/templateStart.php"); ?>
        <h3>Bienvenido, elija su evento: <?php echo $nombre; ?></h3>

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

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <tr>
                    <td colspan="9" class="text-center">
                        Cantidad total de eventos registrados: <?php echo $rs->num_rows; ?>
                    </td>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Nombre evento</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Lugar</th>
                    <th>Estado</th>
                    <th>Inscriptos</th>
                    <th colspan="2" class="text-center">
                        <a href="nuevo.php" class="btn btn-outline-primary btn-sm">Insertar</a>
                    </th>
                </tr>
                <?php
                while ($fila = $rs->fetch_assoc()) {
                    $ahora = new DateTime();
                    $fechaEvento = new DateTime($fila['fecha'] . " " . $fila['hora']);
                    if ($ahora > $fechaEvento) {
                        $estadoCalculado = "<span style='color:red;'>Finalizado</span>";
                    } else {
                        $estadoCalculado = "<span style='color:green;'>Pendiente</span>";
                    }
                ?>
                <tr>
                    <td><?php echo $fila['id']; ?></td>
                    <td><?php echo $fila['titulo']; ?></td>
                    <td><?php echo $fila['fecha']; ?></td>
                    <td><?php echo $fila['hora']; ?></td>
                    <td><?php echo $fila['lugar']; ?></td>
                    <td><?php echo $estadoCalculado; ?></td>
                    <td ><a href="../inscriptos/index.php?id=<?php echo $fila["id"]; ?>" class="btn btn-outline-secondary">Inscriptos</a></td>
                    <td><a href="editar.php?id=<?php echo $fila['id']; ?>" class="btn btn-outline-warning btn-sm">Editar</a></td>
                    <td><a href="borrar.php?id=<?php echo $fila['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Seguro que quieres borrar este evento?');">Borrar</a></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
<?php include(__DIR__ . "/../parciales/templateEnd.php"); ?>
