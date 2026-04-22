    <h3><?php echo $titulo_form; ?></h3>
        <?php if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo "<span style='color: red;'>Error al insertar datos. Por favor, revise los datos ingresados.</span><br><br>";
    }
    ?>
    <?php if (isset($_GET['error']) && $_GET['error'] == 2) {
        echo "<span style='color: red;'>Error al actualizar los datos. Por favor, revise los datos ingresados.</span><br><br>";
    } ?>
    
    <form action="<?php echo $target; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
        <p>
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" maxlength="100" value="<?php echo $fila['nombre']; ?>" required>
        </p>
        <p>
            <label for="apellido">Apellido:</label><br>
            <input type="text" id="apellido" name="apellido" maxlength="100" value="<?php echo $fila['apellido']; ?>" required>
        </p>
        <p>
            <label for="fenac">Fecha de nacimiento:</label><br>
            <input type="date" id="fenac" name="fenac" value="<?php echo $fila['fenac']; ?>" required>
        </p>
        <p>
            <label for="doc">Documento:</label><br>
            <input type="text" id="doc" name="doc" maxlength="191" value="<?php echo $fila['doc']; ?>" required>
        </p>
        <p>
            <label for="mail">Mail:</label><br>
            <input type="email" id="mail" name="mail" maxlength="40" value="<?php echo $fila['mail']; ?>" required>
        </p>
        <p>
            <label for="telefono">Telefono:</label><br>
            <input type="number" id="telefono" name="telefono" value="<?php echo $fila['telefono']; ?>" required>
        </p>
        <p>
            <label for="direccion">Direccion:</label><br>
            <input type="text" id="direccion" name="direccion" maxlength="100" value="<?php echo $fila['direccion']; ?>" required>
        </p>
        <p>
            <label for="contrasena">Contrasena:</label><br>
            <input type="number" id="contrasena" name="contrasena" value="<?php echo $fila['contrasena']; ?>" required>
        </p>
        <p>
            <label for="admin">Admin:</label><br>
            <select id="admin" name="admin" required>
                <option value="si" <?php if ($fila['admin'] == 'si') echo 'selected'; ?>>Si</option>
                <option value="no" <?php if ($fila['admin'] == 'no') echo 'selected'; ?>>No</option>
            </select>
        </p>
        <p>
            <input type="submit" value="Guardar Usuario">
            <a href="index.php">Volver</a>
        </p>
    </form>
