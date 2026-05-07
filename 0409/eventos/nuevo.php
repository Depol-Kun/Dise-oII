<?php
$target = "guardar.php";
$titulo_form = "Agregar Nuevo Evento";
$fila = [
    'id' => '',
    'titulo' => '',
    'fecha' => '',
    'hora' => '',
    'lugar' => '',
    'Estado' => 'As definido'
];

include_once("/var/www/html/0409/parciales/templateStart.php");
include '_form.php';
include_once("/var/www/html/0409/parciales/templateEnd.php");
?>
