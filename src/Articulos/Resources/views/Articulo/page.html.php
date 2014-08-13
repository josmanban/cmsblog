<article>
    <header>
        <h3><?php echo $articulo->getTitulo(); ?> 
            <br><small><i>por </i> <strong><?php echo $articulo->getAutor()->getNombre(); ?></strong> <i>, el 
                    <?php echo $articulo->getFechaHoraPublicacion()->format('d-m-Y'); ?></i> </small>
        </h3>
    </header>
    <div style="text-align: center;">
        <img class="img-rounded img-responsive img-thumbnail" src="<?php echo $articulo->getImagen(); ?>" alt="..."/>
    </div>
    <p>

        <?php echo $articulo->getTexto(); ?>    </p>
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

</article>


<style>
    .coments-container>ul{
        padding-left: 0px;
    }
</style>
<article class="coments-container">
    <header>
        <h3>
            Comentarios:
        </h3>
    </header>
    <?php \Librerias\View::render(COMENTARIO_NEW_FORM, array('post' => $articulo)) ?>
    <?php Librerias\View::render(COMENTARIO_TREE, array('comentarios' => $comentarios)); ?>
</article>

