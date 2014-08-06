

<article class="">
    <header>
        <h3>
            <a href="index.php?controller=articulo&action=show&id=<?php echo $articulo->getId(); ?>">
                <?php echo $articulo->getTitulo(); ?></a><br><small><i>por </i> <strong><?php echo $articulo->getAutor()->getNombre(); ?></strong> <i>, el 
                    <?php echo $articulo->getFechaHoraPublicacion()->format('d-m-Y'); ?></i> </small></h3>

    </header>
    <div style="text-align: center;">
        <img class="img-rounded img-responsive img-thumbnail" src="<?php echo $articulo->getImagen(); ?>" alt="..."/>
    </div>
    <p>

        <?php echo $articulo->getResumen(); ?>    </p>
    <footer>


        <?php if (isset($_SESSION['usuario'])): ?>
            <?php
            $usuario = $_SESSION['usuario'];
            ?>
            <?php
            if (($usuario->esPublicador() && $articulo->esAutor($usuario) ) || $usuario->esAdministradorArticulo() || $usuario->esAdministrador()):
                ?>
                <p>
                    <a href="index.php?controller=articulo&action=edit&id=
                       <?php echo $articulo->getId(); ?>" class="btn btn-success" role="button">Editar</a>
                    <a href="#" class="btn btn-danger" role="button">Eliminar</a>
                </p>
            <?php endif; ?><?php endif; ?>
    </footer>
    <hr>
</article>

