<article style="margin-top:1em;">   
    <style>
        .inscripcion-avatar{
            width: 50%;
            margin:0 25%;
        }
    </style>
    <img class="inscripcion-avatar img-thumbnail img-circle img-responsive" src="<?php
    echo $inscripcionProyecto->getPersona()->getUsuario()->getPerfil()->getAvatar();
    ?>"> 
    <dl class="dl-horizontal">
        <dt>Apellido, nombre:</dt>
        <dd><?php echo $inscripcionProyecto->getPersona()->getApellidoNombre(); ?></dd>
        <dt>Proyecto:</dt>
        <dd><?php echo $inscripcionProyecto->getProyecto()->getTitulo(); ?></dd>
        <dt>Fecha inscripci&oacute;n:</dt>
        <dd><?php echo $inscripcionProyecto->getFechaInscripcion()->format('d-m-Y'); ?></dd>
        <dt>Rol:</dt>
        <dd><?php echo $inscripcionProyecto->getRol()->getNombre(); ?></dd>
        <dt>Estado:</dt>
        <dd><?php echo $inscripcionProyecto->getEstado()->getNombre() ?></dd>

    </dl>
    <footer class="text-center">
        <?php if (isset($_SESSION['usuario'])): ?>
            <?php
            $usuario = $_SESSION['usuario'];
            if ($usuario->esAdministrador() || $usuario->esAdministradorProyecto() || ($inscripcionProyecto->getProyecto()->esAutor($usuario) && $usuario->esPublicadorProyecto())):
                ?>
                <a href="index.php?controller=inscripcionProyecto&action=edit&id=<?php
                echo $inscripcionProyecto->getId();
                ?>" class="btn btn-primary">Editar inscripcion proyecto</a>
            <?php endif; ?>
        <?php endif; ?>
    </footer>
    <hr>
</article>