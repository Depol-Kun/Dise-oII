<?php
include "../lib/conexion.php";
include "../lib/evento.php";

$db = new Conex();
$con = $db->conectar();
$evento = new Evento($con);

if (isset($_GET['id'])) {
    if ($evento->delete($_GET['id'])) {
        header("Location: index.php?ok=3");
        exit();
    }
    header("Location: index.php?error=3");
    exit();
}

echo "ID no proporcionado.";
exit();
?>
