<?php
include __DIR__ . "/../lib/conexion.php";
include __DIR__ . "/../lib/inscripciones.php";
include __DIR__ . "/../lib/evento.php";

$db = new Conex();
$con = $db->conectar();
$inscripcion = new inscripciones($con);
$eventos = new Evento($con);
$evento = ['titulo' => 'Sin evento seleccionado', 'fecha' => '', 'lugar' => ''];
$ev_id = 0;
$rs = $inscripcion->getByEventoID('id');

if (isset($_GET['id']) || isset($_GET['evento_id'])) {
    $ev_id = isset($_GET['id']) ? (int)$_GET['id'] : (int)$_GET['evento_id'];
    $rs = $inscripcion->getByEventoID($ev_id);
    $ev = $eventos->getByID($ev_id);
    $evento = $ev->fetch_assoc() ?: $evento;
}
?>

<?php include_once(__DIR__ . "/../parciales/templateStart.php"); ?>
<h1>Listado de Usuarios</h1>

<?php if (isset($_GET['ok']) && $_GET['ok'] == 1) {
    echo "<span style='color: green;'>Usuario inscrito correctamente.</span><br><br>";
} ?>
<?php if (isset($_GET['ok']) && $_GET['ok'] == 2) {
    echo "<span style='color: green;'>inscrito correctamente.</span><br><br>";
} ?>
<?php if (isset($_GET['ok']) && $_GET['ok'] == 3) {
    echo "<span style='color: green;'>inscrito eliminado correctamente.</span><br><br>";
} ?>
<?php if (isset($_GET['error']) && $_GET['error'] == 3) {
    echo "<span style='color: red;'>Error al eliminar el inscripto.</span><br><br>";
} ?>

<?php if (!$rs) {
    echo "<span style='color: red;'>Error al consultar inscriptos.</span><br><br>";
    include_once(__DIR__ . "/../parciales/templateEnd.php");
    exit;
} ?>

<div class="mb-3">
    <h4>Charla: <?php echo $evento['titulo']; ?></h4>
    <h4>Fecha: <?php echo $evento['fecha']; ?></h4>
    <h4>Lugar: <?php echo $evento['lugar']; ?></h4>
</div>
<a href="../eventos/index.php" class="btn btn-outline-secondary" class="text-center">volver a eventos</a>
<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <tr>
            <th colspan="10" class="text-center">
                Cantidad total de usuarios registrados: <?php echo $rs->num_rows; ?>
            </th>
        </tr>
        <tr>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Estado</th>
            <th>Mail</th>
            <th>Presencia</th>
            <th>Fecha de inscripcion</th>
            <th colspan="3" class="text-center">
                <a href="nuevo.php?id=<?php echo $ev_id; ?>" class="btn btn-outline-primary">Nuevo</a>
            </th>
        </tr>
        <?php while ($fila = $rs->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $fila['apellido']; ?></td>
            <td><?php echo $fila['nombre']; ?></td>
            <td><?php echo $fila['mail']; ?></td>
            <td><?php echo $fila['estado']; ?></td>
            <td class="col-email"><?php echo $fila['mail']; ?></td>
            <td><?php echo $fila['checking']; ?></td>
            <td><?php echo $fila['fecha_inscripcion']; ?></td>
            <td>
                <a href="editar.php?id=<?php echo $fila['id']; ?>&evento_id=<?php echo $ev_id; ?>" class="btn btn-outline-warning btn-sm">Editar</a>
            </td>
            <td>
                <a href="borrar.php?id=<?php echo $fila['id']; ?>&evento_id=<?php echo $ev_id; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar esta inscripción?');">Borrar</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
<?php include_once(__DIR__ . "/../parciales/templateEnd.php"); ?>