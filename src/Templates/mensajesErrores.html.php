<br>
<?php if (isset($mensajesExito)) : ?>
    <div class="alert alert-success">
        <ul>
            <?php foreach ($mensajesExito as $mensajeExito) : ?>
                <li><?php echo $mensajeExito ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (isset($errores)) : ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errores as $error) : ?>
                <li><?php echo $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php
 endif ?>
