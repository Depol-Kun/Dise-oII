<?php
include "../lib/conexion.php";
include "../lib/usuario.php";

$db = new Conex();
$con = $db->conectar();
$datos = new Usuario($con);

if (isset($_GET['id'])){
    if ($rs = $datos->delete($_GET['id'])) {
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
