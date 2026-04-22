<h3><?php echo $titulo_form; ?></h3>
<?php if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo "<span style='color: red;'>Error al insertar datos. Por favor, revise los datos ingresados.</span><br><br>";
} ?>
<?php if (isset($_GET['error']) && $_GET['error'] == 2) {
    echo "<span style='color: red;'>Error al actualizar los datos. Por favor, revise los datos ingresados.</span><br><br>";
} ?>

<div class="mb-3">
    <strong>Evento:</strong> <?php echo $evento['titulo']; ?><br>
    <strong>Fecha:</strong> <?php echo $evento['fecha']; ?><br>
    <strong>Lugar:</strong> <?php echo $evento['lugar']; ?>
</div>

<form action="<?php echo $target; ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
    <input type="hidden" name="evento_id" value="<?php echo $fila['evento_id']; ?>">

    <p>
        <label for="usuario_id">Usuario:</label><br>
        <select id="usuario_id" name="usuario_id" required class="form-control">
            <?php while ($us = $usuarios->fetch_assoc()) { ?>
                <option value="<?php echo $us['id']; ?>" <?php if ($fila['usuario_id'] == $us['id']) echo 'selected'; ?>>
                    <?php echo $us['nombre'] . " " . $us['apellido']; ?>
                </option>
            <?php } ?>
        </select>
    </p>

    <p>
        <label for="estado">Estado:</label><br>
        <select id="estado" name="estado" required class="form-control">
            <option value="1" <?php if ((string)$fila['estado'] === '1') echo 'selected'; ?>>Activo</option>
            <option value="0" <?php if ((string)$fila['estado'] === '0') echo 'selected'; ?>>Inactivo</option>
        </select>
    </p>

    <p>
        <label for="checking">Presencia:</label><br>
        <select id="checking" name="checking" required class="form-control">
            <option value="0" <?php if ((string)$fila['checking'] === '0') echo 'selected'; ?>>No</option>
            <option value="1" <?php if ((string)$fila['checking'] === '1') echo 'selected'; ?>>Si</option>
        </select>
    </p>

    <p>
        <label for="observacion">Observacion:</label><br>
        <textarea id="observacion" name="observacion" class="form-control"><?php echo $fila['observacion']; ?></textarea>
    </p>

    <p>
        <input type="submit" value="Guardar inscripcion">
        <a href="index.php?id=<?php echo $fila['evento_id']; ?>">Volver</a>
    </p>
</form>
