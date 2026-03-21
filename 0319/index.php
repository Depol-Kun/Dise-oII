<?php
date_default_timezone_set('America/Asuncion');
include "lib/conex.php";
$db = new Conex();
$con = $db->conectar();
$sql = "SELECT * FROM eventos;";
$rs = $con->query($sql);

$nombre = "Clases de Informatica";

?>
<html>
    <body>
        <h3>Bienvenido, elija su evento: <?php echo $nombre; ?></h3>
            
        <table border="1">
            <tr>
                <td colspan="6" align="center">
                    Cantidad total de eventos registrados:<?php echo $rs->num_rows; ?> </td>
            </tr>
            <tr>
                <th>ID</th>
                <th>Nombre Evento</th>
                <th>Fecha</th>
                <th>hora</th>
                <th>Lugar</th>
                <th>Estado</th>
            </tr>
          <?php 
            while ($fila = $rs->fetch_assoc()) { 
                $ahora = new DateTime();
            $fechaEvento = new DateTime($fila['fecha'] . " " . $fila['hora']);
            if ($fechaEvento < $ahora) {
                $estadoCalculado = "<span style='color:red;'>Finalizado</span>";
            }       
            else {
                $estadoCalculado = "<span style='color:green;'>Pendiente</span>";
            }
            echo $ahora->format('d/m/Y H:i');
?>
            <tr>
                <td><?php echo $fila['id'];?></td>
                <td><?php echo $fila['titulo'];?></td>
                <td><?php echo $fila['fecha']; ?></td>
                <td><?php echo $fila['hora']; ?></td>
                <td><?php echo $fila['lugar']; ?></td>
                <td><?php echo $estadoCalculado; ?></td>
            </tr>
            <?php 
            } 
            ?>
        </table>
    </body>
</html>