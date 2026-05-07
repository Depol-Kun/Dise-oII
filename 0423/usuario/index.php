<?php
include "../lib/conexion.php";
include "../lib/usuario.php";

$db = new Conex();
$con = $db->conectar();
$usuario = new Usuario($con);
$rs = $usuario->getALL();
?>

<?php include_once(__DIR__ . "/../parciales/templateStart.php"); ?>
                <h1>Listado de Usuarios</h1>

        <?php if (isset($_GET['ok']) && $_GET['ok'] == 1) {
        echo "<span style='color: green;'>Usuario insertado correctamente.</span><br><br>";
        } ?>
        <?php if (isset($_GET['ok']) && $_GET['ok'] == 2) {
        echo "<span style='color: green;'>Usuario actualizado correctamente.</span><br><br>";
        } ?>
        <?php if (isset($_GET['ok']) && $_GET['ok'] == 3) {
        echo "<span style='color: green;'>Usuario eliminado correctamente.</span><br><br>";
    } ?>
        <?php if (isset($_GET['error']) && $_GET['error'] == 3) {
        echo "<span style='color: red;'>Error al eliminar el usuario.</span><br><br>";
    } ?>

        <div 
        <div class="table table-striped table-hover">
            <table class="table table-striped table-bordered align-middle">
                    <tr>
                        <th colspan="10" class="text-center">
                            Cantidad total de usuarios registrados: <?php echo $rs->num_rows; ?>
                        </th>

                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Doc</th>
                    <th>Mail</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Admin</th>
                    <th colspan="3" class="text-center">
                        <a href="nuevo.php" class="btn btn-outline-primary">Insertar</a>
                    </th>
                </tr>
                <?php 
                while ($fila = $rs->fetch_assoc()) { 
                ?>
                <tr>
                    <td><?php echo $fila['id']; ?></td>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['apellido']; ?></td>
                    <td><?php echo $fila['doc']; ?></td>
                    <td class="col-email"><?php echo $fila['mail']; ?></td>
                    <td><?php echo $fila['telefono']; ?></td>
                    <td><?php echo $fila['direccion']; ?></td>
                    <td><?php echo $fila['admin']; ?></td>
                    <td><a href="editar.php?id=<?php echo $fila['id']; ?>" class="btn btn-outline-warning btn-sm">Editar</a></td>
                    <td><a href="borrar.php?id=<?php echo $fila['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Seguro que quieres borrar este usuario?');">Borrar</a></td>
                </tr>
                <?php 
                } 
                ?>
            </table>
        </div>
<?php include_once(__DIR__ . "/../parciales/templateEnd.php"); ?>
