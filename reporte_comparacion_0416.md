# Comparación de carpeta 0416

Comparación entre:
- Local: /var/www/html/0416
- Remoto: https://github.com/queavos/sz33Dw2 (carpeta 0416)

## Resumen

| Métrica | Cantidad |
|---|---:|
| Solo en tu 0416 | 18 |
| Solo en repo remoto | 19 |
| Archivos en común | 17 |
| En común con contenido distinto | 17 |

## Diferencias de estructura

### Solo en tu 0416
- lib/conexion.php
- lib/evento.php
- lib/inscripciones.php
- lib/usuario.php
- parciales/aside1.php
- parciales/aside2.php
- parciales/footer.php
- parciales/head.php
- parciales/header.php
- parciales/templateEnd.php
- parciales/templateStart.php
- usuario/_form.php
- usuario/actualizar.php
- usuario/borrar.php
- usuario/editar.php
- usuario/guardar.php
- usuario/index.php
- usuario/nuevo.php

### Solo en repo remoto
- lib/Evento.php
- lib/Inscripciones.php
- lib/Usuario.php
- lib/app.php
- lib/conex.php
- partials/aside1.php
- partials/aside2.php
- partials/footer.php
- partials/head.php
- partials/header.php
- partials/template_end.php
- partials/template_start.php
- usuarios/_form.php
- usuarios/actualizar.php
- usuarios/borrar.php
- usuarios/editar.php
- usuarios/guardar.php
- usuarios/index.php
- usuarios/nuevo.php

## Archivos en común con contenido diferente

- acercade.php
- contactos.php
- eventos/_form.php
- eventos/actualizar.php
- eventos/borrar.php
- eventos/editar.php
- eventos/guardar.php
- eventos/index.php
- eventos/nuevo.php
- index.php
- inscriptos/_form.php
- inscriptos/actualizar.php
- inscriptos/borrar.php
- inscriptos/editar.php
- inscriptos/guardar.php
- inscriptos/index.php
- inscriptos/nuevo.php

## Diferencias clave observadas

- Convenciones de nombres: en local se usa parciales/usuario y en remoto partials/usuarios.
- Convenciones de modelos: en local hay lib/conexion.php, lib/evento.php, lib/usuario.php, lib/inscripciones.php; en remoto se usan variantes como lib/conex.php, lib/Evento.php, lib/Usuario.php, lib/Inscripciones.php.
- Enlaces y templates: tu versión local quedó orientada a 0416; el remoto usa su propia estructura con partials/template_start.php y template_end.php.
- Lógica funcional: eventos e inscriptos comparten propósito, pero difieren en validaciones, nombres de campos y flujo de navegación.

## Muestras de diff (extracto)

### index.php

```diff
--- /var/www/html/0416/index.php	2026-04-17 21:25:13.901284700 +0000
+++ /tmp/compare_sz33Dw2/sz33Dw2-main/0416/index.php	2026-04-17 00:27:10.000000000 +0000
@@ -1,5 +1,4 @@
-
-<?php include_once("/var/www/html/0416/parciales/templateStart.php"); ?>
-                <h1>Bienvenido a la aplicación</h1>
-<?php include_once("/var/www/html/0416/parciales/templateEnd.php"); ?>
-        
+<?php include_once 'partials/template_start.php'; ?>
+                <h1>Bienvenidos a la aplicación</h1>    
+                <p>esta es la seccion principal de la aplicación</p>    
+<?php include_once 'partials/template_end.php'; ?>            
\ No newline at end of file
```

### eventos/index.php

```diff
--- /var/www/html/0416/eventos/index.php	2026-04-17 21:17:32.298685200 +0000
+++ /tmp/compare_sz33Dw2/sz33Dw2-main/0416/eventos/index.php	2026-04-17 00:27:10.000000000 +0000
@@ -1,73 +1,71 @@
 <?php
-date_default_timezone_set('America/Asuncion');
-include "../lib/conexion.php";
-include "../lib/evento.php";
+include "../lib/conex.php"; // incluimos clase de conexion
+include "../lib/Evento.php";
+$db=new Conex(); //creamos la conexion (instanciamos)
+$con=$db->conectar(); // conectamos a la db
+//$sql="select * from eventos"; // creamos una consulta 
+//$rs=$con->query($sql); // ejecutamos la consulta
+$evento= new Evento($con);
+$rs=$evento->getALL();
+?>
+<?php include_once '../partials/template_start.php'; ?>
+             
+<h3>   
+<?php 
+//echo "Bienvenidos ".$nombre."!!! ".$valor;
+?>    
+</h3>
+  <?php 
+  if (isset($_GET['ok']) && $_GET['ok'] == 1) {
+      echo "<p style='color:green;'>Evento insertado correctamente.</p>";
+  }
+  ?>
+  <?php 
+  if (isset($_GET['ok']) && $_GET['ok'] == 2) {
+      echo "<p style='color:green;'>Evento actualizado correctamente.</p>";
+  }
+  ?>
+    <?php 
+  if (isset($_GET['ok']) && $_GET['ok'] == 3) {
+      echo "<p style='color:green;'>Evento eliminado correctamente.</p>";
+  }
+  ?>
+  <?php 
+  if (isset($_GET['error']) && $_GET['error'] == 3) {
+      echo "<p style='color:red;'>Error al eliminar el evento.</p>";
+  }
+  ?>
+<table class="table table-striped ">
+<tr>
+    <th>id</th>
+    <th>titulo</th>
+    <th>lugar</th>
+    <th>fecha</th>
+    <th>hora</th>
+    <th>Activo</th>
+    <th colspan="3"><a href="nuevo.php" class="btn btn-outline-primary">Nuevo</a></th>
+</tr>
+</tr>
+
+<?php 
+while ($fila= $rs->fetch_assoc()) //loop while que se ejecuta mientras haya fila en el array asociativo
+    { ?>
+       
+<tr>
+    <td> <?php echo $fila["id"]; ?></td>
+    <td> <?php echo $fila["titulo"]; ?></td>
+    <td> <?php echo $fila["lugar"]; ?></td>
+    <td> <?php echo $fila["hora"]; ?></td>
+    <td> <?php echo $fila["fecha"]; ?></td>
+    <td> <?php if($fila["activo"]) { echo "Si"; } else { echo "NO";} ?></td>
+    <td ><a href="editar.php?id=<?php echo $fila["id"]; ?>" class="btn btn-outline-warning">Editar</a></td>
+    <td ><a href="borrar.php?id=<?php echo $fila["id"]; ?>" class="btn btn-outline-danger">Borrar</a></td>
+<td ><a href="../inscriptos/index.php?id=<?php echo $fila["id"]; ?>" class="btn btn-outline-secondary">Inscriptos</a></td>
+</tr>
 
-$db = new Conex();
-$con = $db->conectar();
-$evento = new Evento($con);
-$rs = $evento->getALL();
-$nombre = "Clases de Informatica";
+<?php     }
 ?>
-<?php include("/var/www/html/0416/parciales/templateStart.php"); ?>
-        <h3>Bienvenido, elija su evento: <?php echo $nombre; ?></h3>
 
-        <?php if (isset($_GET['ok']) && $_GET['ok'] == 1) {
-            echo "<span style='color: green;'>Evento insertado correctamente.</span><br><br>";
-        } ?>
-        <?php if (isset($_GET['ok']) && $_GET['ok'] == 2) {
-            echo "<span style='color: green;'>Evento actualizado correctamente.</span><br><br>";
-        } ?>
-        <?php if (isset($_GET['ok']) && $_GET['ok'] == 3) {
-            echo "<span style='color: green;'>Evento eliminado correctamente.</span><br><br>";
-        } ?>
-        <?php if (isset($_GET['error']) && $_GET['error'] == 3) {
-            echo "<span style='color: red;'>Error al eliminar el evento.</span><br><br>";
-        } ?>
+</table>
 
-        <div class="table-responsive">
-            <table class="table table-striped table-bordered align-middle">
-                <tr>
-                    <td colspan="9" class="text-center">
-                        Cantidad total de eventos registrados: <?php echo $rs->num_rows; ?>
-                    </td>
-                </tr>
-                <tr>
-                    <th>ID</th>
-                    <th>Nombre evento</th>
-                    <th>Fecha</th>
-                    <th>Hora</th>
-                    <th>Lugar</th>
-                    <th>Estado</th>
-                    <th>Inscriptos</th>
-                    <th colspan="2" class="text-center">
-                        <a href="nuevo.php" class="btn btn-outline-primary btn-sm">Insertar</a>
-                    </th>
-                </tr>
-                <?php
-                while ($fila = $rs->fetch_assoc()) {
-                    $ahora = new DateTime();
-                    $fechaEvento = new DateTime($fila['fecha'] . " " . $fila['hora']);
-                    if ($ahora > $fechaEvento) {
-                        $estadoCalculado = "<span style='color:red;'>Finalizado</span>";
-                    } else {
-                        $estadoCalculado = "<span style='color:green;'>Pendiente</span>";
-                    }
-                ?>
-                <tr>
-                    <td><?php echo $fila['id']; ?></td>
-                    <td><?php echo $fila['titulo']; ?></td>
-                    <td><?php echo $fila['fecha']; ?></td>
-                    <td><?php echo $fila['hora']; ?></td>
-                    <td><?php echo $fila['lugar']; ?></td>
-                    <td><?php echo $estadoCalculado; ?></td>
-                    <td ><a href="../inscriptos/index.php?evento_id=<?php echo $fila["id"]; ?>" class="btn btn-outline-secondary">Inscriptos</a></td>
-                    <td><a href="editar.php?id=<?php echo $fila['id']; ?>" class="btn btn-outline-warning btn-sm">Editar</a></td>
-                    <td><a href="borrar.php?id=<?php echo $fila['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Seguro que quieres borrar este evento?');">Borrar</a></td>
-                </tr>
-                <?php
-                }
-                ?>
-            </table>
-        </div>
-<?php include("/var/www/html/0416/parciales/templateEnd.php"); ?>
+<?php include_once '../partials/template_end.php'; ?>  
\ No newline at end of file
```

### inscriptos/index.php

```diff
--- /var/www/html/0416/inscriptos/index.php	2026-04-17 21:21:41.539114200 +0000
+++ /tmp/compare_sz33Dw2/sz33Dw2-main/0416/inscriptos/index.php	2026-04-17 00:27:10.000000000 +0000
@@ -1,91 +1,90 @@
 <?php
-include __DIR__ . "/../lib/conexion.php";
-include __DIR__ . "/../lib/inscripciones.php";
-include __DIR__ . "/../lib/evento.php";
-
-$db = new Conex();
-$con = $db->conectar();
-$inscripciones = new inscripciones($con);
-$eventoModelo = new Evento($con);
-$evento = ['titulo' => 'Sin evento seleccionado', 'fecha' => '', 'lugar' => ''];
-$eventoIdActual = 0;
-$rs = $inscripciones->getALL();
-
-if (isset($_GET['evento_id']) || isset($_GET['id'])) {
-    $eventoId = isset($_GET['evento_id']) ? (int)$_GET['evento_id'] : (int)$_GET['id'];
-    $eventoIdActual = $eventoId;
-    $rs = $inscripciones->getByEventoID($eventoId);
-    $ev = $eventoModelo->getByID($eventoId);
-    $evento = $ev->fetch_assoc() ?: $evento;
-}
+include "../lib/conex.php"; // incluimos clase de conexion
+include "../lib/Inscripciones.php";
+include "../lib/Evento.php";
+$db=new Conex(); //creamos la conexion (instanciamos)
+$con=$db->conectar(); // conectamos a la db
+//$sql="select * from eventos"; // creamos una consulta 
+//$rs=$con->query($sql); // ejecutamos la consulta
+$inscripcion= new Inscripciones($con);
+$eventos= new Evento($con);    
+if (isset($_GET['id'])) {
+    $rs=$inscripcion->getByEventoID($_GET['id']);
+    $ev=$eventos->getByID($_GET['id']);
+    $evento=$ev->fetch_assoc();
+    $ev_id=$_GET['id'];
+} 
+//$rs=$inscripcion->getALL();
 ?>
+<?php include_once '../partials/template_start.php'; ?>
+             
+<h3>   
+<?php 
+//echo "Bienvenidos ".$nombre."!!! ".$valor;
+?>    
+</h3>
+  <?php 
+  if (isset($_GET['ok']) && $_GET['ok'] == 1) {
+      echo "<p style='color:green;'> Inscripción correctamente.</p>";
+  }
+  ?>
+  <?php 
+  if (isset($_GET['ok']) && $_GET['ok'] == 2) {
+      echo "<p style='color:green;'>Inscripción actualizada correctamente.</p>";
+  }
+  ?>
+    <?php 
+  if (isset($_GET['ok']) && $_GET['ok'] == 3) {
+      echo "<p style='color:green;'>Inscripción eliminada correctamente.</p>";
+  }
+  ?>
+  <?php 
+  if (isset($_GET['error']) && $_GET['error'] == 3) {
+      echo "<p style='color:red;'>Error al eliminar el evento.</p>";
+  }
+  ?>
+  <div>
+    <h3>Charla: <?php echo $evento['titulo']; ?></h3>
+    <h4>Fecha: <?php echo $evento['fecha']; ?></h4>
+    <h4>Lugar: <?php echo $evento['lugar']; ?></h4>
+  </div>  
 
-<?php include_once(__DIR__ . "/../parciales/templateStart.php"); ?>
-<h1>Listado de Usuarios</h1>
+<table class="table table-striped ">
+<tr>
+    <th>Apellido</th>
+    <th>Nombre</th>
+    <th>Correo</th>
+    <th>Estado</th>
+    <th>Presente</th>
+    <th>Fecha Inscripcion</th>
+    <th >
+        <a href="nuevo.php?evento_id=<?php echo $ev_id; ?>" class="btn btn-outline-primary">Nuevo</a>
+     </th>
+        <th colspan="2">   
+        <a href="../eventos/index.php" class="btn btn-outline-secondary">Volver a Eventos</a>
+    </th>
+</tr>
+</tr>
+
+<?php 
+while ($fila= $rs->fetch_assoc()) //loop while que se ejecuta mientras haya fila en el array asociativo
+    { ?>
+       
+<tr>
+    <td> <?php echo $fila["apellido"]; ?></td>
+    <td> <?php echo $fila["nombre"]; ?></td>
+    <td> <?php echo $fila["mail"]; ?></td>
+    <td> <?php echo $fila["estado"]; ?></td>
+    <td> <?php echo $fila["checkin"]; ?></td>
+    <td> <?php echo $fila["fecha_inscripcion"]; ?></td>
+    <td ><a href="editar.php?id=<?php echo $fila["id"]; ?>&evento_id=<?php echo $ev_id; ?>" class="btn btn-outline-warning">Editar</a></td>
+    <td ><a href="borrar.php?id=<?php echo $fila["id"]; ?>&evento_id=<?php echo $ev_id; ?>" class="btn btn-outline-danger">Borrar</a></td>
 
-<?php if (isset($_GET['ok']) && $_GET['ok'] == 1) {
-    echo "<span style='color: green;'>Usuario inscrito correctamente.</span><br><br>";
-} ?>
-<?php if (isset($_GET['ok']) && $_GET['ok'] == 2) {
-    echo "<span style='color: green;'>inscrito correctamente.</span><br><br>";
-} ?>
-<?php if (isset($_GET['ok']) && $_GET['ok'] == 3) {
-    echo "<span style='color: green;'>inscrito eliminado correctamente.</span><br><br>";
-} ?>
-<?php if (isset($_GET['error']) && $_GET['error'] == 3) {
-    echo "<span style='color: red;'>Error al eliminar el inscripto.</span><br><br>";
-} ?>
-
-<?php if (!$rs) {
-    echo "<span style='color: red;'>Error al consultar inscriptos.</span><br><br>";
-    include_once(__DIR__ . "/../parciales/templateEnd.php");
-    exit;
-} ?>
+</tr>
 
-<div class="mb-3">
-    <h4>Charla: <?php echo $evento['titulo']; ?></h4>
-    <h4>Fecha: <?php echo $evento['fecha']; ?></h4>
-    <h4>Lugar: <?php echo $evento['lugar']; ?></h4>
-</div>
+<?php     }
+?>
+
+</table>
 
-<div class="table-responsive">
-    <table class="table table-striped table-bordered align-middle">
-        <tr>
-            <th colspan="10" class="text-center">
-                Cantidad total de usuarios registrados: <?php echo $rs->num_rows; ?>
-            </th>
-        </tr>
-        <tr>
-            <th>Apellido</th>
-            <th>Nombre</th>
-            <th>Correo</th>
-            <th>Estado</th>
-            <th>Mail</th>
-            <th>Presencia</th>
-            <th>Fecha de inscripcion</th>
-            <th>Acciones</th>
-            <th colspan="3" class="text-center">
-                <a href="nuevo.php?evento_id=<?php echo $eventoIdActual; ?>" class="btn btn-outline-primary">Nuevo</a>
-                <a href="../eventos/index.php" class="btn btn-outline-secondary">volver a eventos</a>
-            </th>
-        </tr>
-        <?php while ($fila = $rs->fetch_assoc()) { ?>
-        <tr>
-            <td><?php echo $fila['apellido']; ?></td>
-            <td><?php echo $fila['nombre']; ?></td>
-            <td><?php echo $fila['mail']; ?></td>
-            <td><?php echo $fila['estado']; ?></td>
-            <td class="col-email"><?php echo $fila['mail']; ?></td>
-            <td><?php echo $fila['checking']; ?></td>
-            <td><?php echo $fila['fecha_inscripcion']; ?></td>
-            <td>
-                <a href="editar.php?id=<?php echo $fila['id']; ?>" class="btn btn-outline-warning btn-sm">Editar</a>
-            </td>
-            <td>
-                <a href="borrar.php?id=<?php echo $fila['id']; ?>&evento_id=<?php echo $eventoIdActual; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar esta inscripción?');">Borrar</a>
-            </td>
-        </tr>
-        <?php } ?>
-    </table>
-</div>
-<?php include_once(__DIR__ . "/../parciales/templateEnd.php"); ?>
\ No newline at end of file
+<?php include_once '../partials/template_end.php'; ?>  
\ No newline at end of file
```
