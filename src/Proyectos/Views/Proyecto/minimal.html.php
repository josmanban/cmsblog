
<style>
    .minimalProjectData{
        list-style: none;
        padding-left: 0px;
    }
    .minimalProjectTitle{
        text-transform: uppercase;
    }
</style>
<article class=".minimalProject">
    <header>
        <h3 class="minimalProjectTitle">
            <a href="index.php?controller=proyecto&action=show&id=<?php echo $proyecto->getId(); ?>">
                <?php echo $proyecto->getTitulo(); ?></a>    
        </h3>
    </header>   
    <div style="text-align: center;">
        <img class="img-rounded img-responsive img-thumbnail" src="<?php echo $proyecto->getImagen(); ?>" alt="..."/>
    </div>

    <ul class="minimalProjectData">
        <li><b>Codename:</b>
            <?php echo $proyecto->getCodename(); ?></li>
        <li><b>Fecha inicio:</b>
            <?php echo $proyecto->getFechaInicio()->format('d-m-Y'); ?></li>
        <li><b>Descripci&oacute;n:</b>
            <?php echo $proyecto->getResumen(); ?> </li>
    </ul>


    <footer>       
        <?php if (isset($_SESSION['usuario'])): ?>
            <?php
            $usuario = $_SESSION['usuario'];
            ?>
            <?php
            if (($usuario->esPublicadorProyecto() && $proyecto->esAutor($usuario) ) || $usuario->esAdministradorProyecto() || $usuario->esAdministrador()):
                ?>
                <p>
                    <a href="index.php?controller=proyecto&action=edit&id=
                       <?php echo $proyecto->getId(); ?>" class="btn btn-success" role="button">Editar</a>
                    <a href="#" class="btn btn-danger" role="button">Eliminar</a>
                </p>
            <?php endif; ?><?php endif; ?>
    </footer>
    <hr>
</article>

