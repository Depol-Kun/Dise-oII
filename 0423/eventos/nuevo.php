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

include_once(__DIR__ . "/../parciales/templateStart.php");
include '_form.php';
include_once(__DIR__ . "/../parciales/templateEnd.php");
?>
