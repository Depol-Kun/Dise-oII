<h3><?php echo $titulo_form; ?></h3>
<?php if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo "<span style='color: red;'>Error al insertar datos. Por favor, revise los datos ingresados.</span><br><br>";
} ?>
<?php if (isset($_GET['error']) && $_GET['error'] == 2) {
    echo "<span style='color: red;'>Error al actualizar los datos. Por favor, revise los datos ingresados.</span><br><br>";
} ?>

<form action="<?php echo $target; ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
    <p>
        <label for="titulo">Titulo del evento:</label><br>
        <input type="text" id="titulo" name="titulo" maxlength="100" value="<?php echo $fila['titulo']; ?>" required>
    </p>
    <p>
        <label for="fecha">Fecha:</label><br>
        <input type="date" id="fecha" name="fecha" value="<?php echo $fila['fecha']; ?>" required>
    </p>
    <p>
        <label for="hora">Hora:</label><br>
        <input type="time" id="hora" name="hora" value="<?php echo $fila['hora']; ?>" required>
    </p>
    <p>
        <label for="lugar">Lugar:</label><br>
        <input type="text" id="lugar" name="lugar" maxlength="191" value="<?php echo $fila['lugar']; ?>" required>
    </p>
    <p>
        <label for="Estado">Estado:</label><br>
        <select id="Estado" name="Estado" required>
            <option value="As definido" <?php if ($fila['Estado'] == 'As definido') echo 'selected'; ?>>As definido</option>
            <option value="Pendiente" <?php if ($fila['Estado'] == 'Pendiente') echo 'selected'; ?>>Pendiente</option>
            <option value="Finalizado" <?php if ($fila['Estado'] == 'Finalizado') echo 'selected'; ?>>Finalizado</option>
        </select>
    </p>
    <p>
        <input type="submit" value="Guardar Evento">
        <a href="index.php">Volver</a>
    </p>
</form>
