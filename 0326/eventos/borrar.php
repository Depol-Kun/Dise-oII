<?php
include "../lib/conexion.php";
include "../lib/evento.php";

$db = new Conex();
$con = $db->conectar();
$evento = new Evento($con);

if (isset($_GET['id'])){
    if ($rs = $evento->delete($_GET['id'])) {
        header("Location: index.php?ok=3");
        exit();
    } else {
        header("Location: index.php?error=3");
        exit();
    }
} else {
    echo "ID no proporcionado.";
    exit();
}
?>
