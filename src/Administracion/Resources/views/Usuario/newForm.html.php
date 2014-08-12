<form role="form" method="POST" action="index.php?controller=usuario&action=create" enctype="multipart/form-data">
    <input
        type="hidden" name="id" value="-1"
        >
    <div class="form-group">
        <label>Nombre usuario:</label>

        <input class="form-control" type="text" name="nombre" required>          

    </div>
    <div class="form-group">
        <label>Password:</label>

        <input class="form-control" type="password" name="password" required>

    </div>
    <div class="form-group">
        <label>Repetir password:</label>

        <input class="form-control" type="password" name="repetirPassword" required>

    </div>
    <div class="form-group">
        <label>Email:</label>

        <input class="form-control" type="email" name="email" required>

    </div>
    <?php require_once PERFIL_FORM; ?>
    <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']->esAdministrador()): ?>
        <div class="form-group">
            <label>Rol:</label>
            <?php foreach ($roles as $rol): ?>
                <ul class="list-unstyled">
                    <li>  <label>
                            <input type="checkbox"  value="<?php echo $rol->getId() ?>" name="roles[]">
                            <?php echo $rol->getNombre(); ?></label></li>
                </ul>
            <?php endforeach; ?>          
        </div>
        <div class="form-group">
            <label>Estado</label>
            <select>
                <?php foreach ($estados as $estado): ?>
                    <option value="<?php echo $estado->getId() ?>" name="estado">
                        <?php echo $estado->getNombre(); ?>
                    </option>
                <?php endforeach;
                ?> 
            </select>
        </div>
    <?php endif ?>

    <button type="submit" class="btn btn-primary">Aceptar</button>

    <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']->esAdministrador()): ?>
        <a href="index.php?controller=usuario&action=index" class="btn btn-default">Cancelar</a>
    <?php else : ?>
        <a href="index.php" class="btn btn-default">Cancelar</a>
    <?php endif; ?>

</form>
