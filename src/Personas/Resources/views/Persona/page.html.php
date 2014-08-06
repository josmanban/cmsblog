<dl class="dl-horizontal">
    <?php if (!isset($persona)): ?>
        <dt>Apellido, nombre:</dt>
        <dd></dd>
        <dt>Usuario asignado:</dt>
        <dd></dd>
        <dt>Fecha nacimiento:</dt>
        <dd></dd>
        <dt>Lugar nacimiento:</dt>
        <dd></dd>
        <dt>Tipo documento:</dt>
        <dd></dd>
        <dt>Nº documento:</dt>
        <dd></dd>
        <dt>Sexo:</dt>
        <dd></dd>
        <dt>Estado:</dt>
        <dd></dd>
        <dt></dt>        
        <dd><a href="index.php?controller=persona&action=new" class="btn btn-primary">Completar datos personales</a></dd>

    <?php else: ?>
        <dt>Apellido, nombre:</dt>
        <dd><?php echo $persona->getApellidoNombre(); ?></dd>
        <dt>Usuario asignado:</dt>
        <dd><?php echo $persona->getUsuario()->getNombre(); ?></dd>
        <dt>Fecha nacimiento:</dt>
        <dd><?php echo $persona->getFechaNacimientoStr(); ?></dd>
        <dt>Lugar nacimiento:</dt>
        <dd><?php echo $persona->getLugarNacimiento(); ?></dd>
        <dt>Tipo documento:</dt>
        <dd><?php echo $persona->getTipoDocumento()->getNombre(); ?></dd>
        <dt>Nº documento:</dt>
        <dd><?php echo $persona->getNumDocumento(); ?></dd>
        <dt>Sexo:</dt>
        <dd><?php echo $persona->getSexo()->getNombre(); ?></dd>
        <dt>Estado:</dt>
        <dd><?php echo $persona->getEstado()->getNombre(); ?></dd>
        <dt></dt>        
        <dd><a href="index.php?controller=persona&action=edit&id=<?php
            echo $persona->getId();
            ?>" class="btn btn-primary">Editar datos personales</a></dd>

    <?php endif; ?>



</dl>
