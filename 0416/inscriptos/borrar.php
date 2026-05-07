<?php
include "../lib/conexion.php";
include "../lib/inscripciones.php";

$db = new Conex();
$con = $db->conectar();
$datos = new inscripciones($con);

$ev_id = isset($_GET['evento_id']) ? (int)$_GET['evento_id'] : 0;

if (isset($_GET['id'])) {
    if ($datos->delete((int)$_GET['id'])) {
        header("Location: index.php?id=" . $ev_id . "&ok=3");
        exit();
    }

    header("Location: index.php?id=" . $ev_id . "&error=3");
    exit();
}

echo "ID no proporcionado.";
exit();
?>
