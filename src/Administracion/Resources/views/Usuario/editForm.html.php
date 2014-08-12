<form role="form" method="POST" action="index.php?controller=usuario&action=update">
    <input
        type="hidden" name="id" value="<?php echo $usuario->getId() ?>"
        >

    <div class="form-group">
        <label>Nombre usuario:</label>

        <input class="form-control" type="text" name="nombre" required
               value="<?php echo $usuario->getNombre() ?>" readonly="true"
               >          

    </div>

    <div class="form-group">
        <label>Password:</label>

        <input class="form-control" type="password" name="password">

    </div>
    <div class="form-group">
        <label>Repetir password:</label>

        <input class="form-control" type="password" name="repetirPassword">

    </div>


    <?php if ($_SESSION['usuario']->esAdministrador()): ?>
        <div class="form-group">
            <label>Email:</label>
            <input class="form-control" type="email" name="email" required
                   value="<?php echo $usuario->getEmail() ?>">
        </div>
    <?php else: ?>
        <div class="form-group">
            <label>Email:</label>
            <p class="form-control-static"><?php echo $usuario->getEmail() ?></p>
        </div>
    <?php endif; ?>

    <?php
    if (isset($_SESSION['usuario']))
        $perfil = $_SESSION['usuario']->getPerfil();
    require_once PERFIL_FORM;
    ?>

<?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']->esAdministrador()): ?>
        <div class="form-group">
            <label>Rol:</label>
    <?php foreach ($roles as $rol): ?>
                <ul class="list-unstyled">
                    <li>  <label>
                            <input type="checkbox"  value="<?php echo $rol->getId() ?>" name="roles[]"
                            <?php
                            foreach ($usuario->getRoles() as $rolUsuario) {
                                if ($rolUsuario->getId() == $rol->getId())
                                    echo " checked ";
                            }
                            ?>>
                <?php echo $rol->getNombre(); ?></label></li>
                </ul>
    <?php endforeach; ?>          
        </div>
        <div class="form-group">
            <label>Estado</label>
            <select>
                <?php foreach ($estados as $estado): ?>
                    <option value="<?php echo $estado->getId() ?>" name="estado"
                    <?php
                    if ($estado->getId() == $usuario->getEstado()->getId())
                        echo " selected ";
                    ?>>
                    <?php echo $estado->getNombre(); ?>
                    </option>
                <?php endforeach;
                ?> 
            </select>
        </div>

<?php endif ?>


    <button type="submit" class="btn btn-primary">Aceptar</button>

    <?php if ($_SESSION['usuario']->esAdministrador()): ?>
        <a href="index.php?controller=usuario&action=index" class="btn btn-default">Cancelar</a>
    <?php else : ?>
        <a href="index.php" class="btn btn-default">Cancelar</a>
<?php endif; ?>


</form>
