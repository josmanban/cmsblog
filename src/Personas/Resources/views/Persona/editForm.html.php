
<?php if (isset($persona)): ?>
    <form role="form" action="index.php?controller=persona&action=update" method="POST" enctype="multipart/form-data">
    <?php else: ?>
        <form role="form" action="index.php?controller=persona&action=create" method="POST">
        <?php endif; ?>
        <input type="hidden" name="id" value="<?php
        if (isset($persona))
            echo $persona->getId();
        else {
            echo -1;
        }
        ?>">
        <div class="form-group">
            <label for="exampleInputEmail1">Nombre:</label>
            <input type="text" class="form-control" name="nombre" required value="<?php
            if (isset($persona))
                echo $persona->getNombre();
            ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Apellido:</label>
            <input type="text" class="form-control" name="apellido" required value="<?php
            if (isset($persona))
                echo $persona->getApellido();
            ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Fecha nacimiento:</label>
            <input type="text" class="form-control" name="fechaNacimiento" required value="<?php
            if (isset($persona))
                if (is_object($persona->getFechaNacimiento()))
                    echo $persona->getFechaNacimiento()->format('d-m-Y');
                else
                    echo $persona->getFechaNacimiento();
            ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Lugar nacimiento:</label>
            <input type="text" class="form-control" name="lugarNacimiento" value="<?php
            if (isset($persona))
                echo $persona->getLugarNacimiento();
            ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Número documento:</label>
            <input type="text" class="form-control" name="numDocumento" value="<?php
            if (isset($persona))
                echo $persona->getNumDocumento();
            ?>">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Tipo documento:</label>
            <select class="form-control" name="tipoDocumento">
                <?php if (isset($tiposDocumento)): ?>
                    <?php foreach ($tiposDocumento as $tipoDocumento): ?>
                        <option value="<?php
                        echo $tipoDocumento->getId();
                        ?>"
                                <?php
                                if (isset($persona) && !is_null($persona->getTipoDocumento()))
                                    if ($persona->getTipoDocumento()->getId() == $tipoDocumento->getId())
                                        echo 'selected';
                                ?>
                                >
                                    <?php echo $tipoDocumento->getNombre(); ?>
                        </option>
                    <?php endforeach;
                    ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Sexo:</label>
            <select class="form-control" name="sexo">
                <?php if (isset($sexos)): ?>
                    <?php foreach ($sexos as $sexo): ?>
                        <option value="<?php
                        echo $sexo->getId();
                        ?>"
                                <?php
                                if (isset($persona) && !is_null($persona->getSexo()))
                                    if ($persona->getSexo()->getId() == $sexo->getId())
                                        echo 'selected';
                                ?>
                                >
                                    <?php echo $sexo->getNombre(); ?>
                        </option>
                    <?php endforeach;
                    ?>
                <?php endif; ?>
            </select>
        </div>



        <div class="form-group">
            <label>Usuario asignado:</label>
            <?php if ($_SESSION['usuario']->esAdministrador()): ?>
                <select name="usuario" required>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?php echo $usuario->getId(); ?>"
                        <?php
                        if (isset($_SESSION['usuario']) && $_SESSION['usuario']->getId() == $usuario->getId())
                            echo "selected";
                        ?>>
                                    <?php echo $usuario->getNombre(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php else: ?>            
                <input type="hidden" name="usuario" value="<?php
                echo $_SESSION['usuario']->getId();
                ?>">
                <input class="form-control" type="text" readonly="true" value="<?php
                echo $_SESSION['usuario']->getNombre();
                ?>">
                   <?php endif; ?>
        </div>


        <button type="submit" class="btn btn-primary">Aceptar</button>

        <?php if ($_SESSION['usuario']->esAdministrador()): ?>
            <a href="index.php?controller=persona&action=index" class="btn btn-default">Cancelar</a>
        <?php else : ?>
            <a href="index.php" class="btn btn-default">Cancelar</a>
        <?php endif; ?>

    </form>
