<div class="media">
    <hr>
    <a class="pull-left" href="#">
        <img class="media-object img-thumbnail avatar-comments" src="<?php
        if (!is_null($comentario->getAutor()->getPerfil()))
            echo $comentario->getAutor()->getPerfil()->getAvatar();
        else
            echo USER_DEFAULT_AVATAR;
        //echo $comentario->getAutor()->getPerfil()->getAvatar();
        ?>" alt="...">
    </a>
    <div class="media-body">
        <span class="label label-info" style="float:right">
            Nº <?php echo $comentario->getId() ?>
            <?php if (!is_null($comentario->getPadre())) echo "| Respuesta a Nº " . $comentario->getPadre()->getId(); ?>
        </span>
        <h4 class="media-heading">
            <?php echo $comentario->getAutor()->getNombre(); ?><br> 
            <small><i>el <?php echo $comentario->getFechaHora()->format('d/m/Y H:i'); ?> hs</i></small>
        </h4> 
        <br>
        <?php echo $comentario->getTexto(); ?>

        <?php if (isset($_SESSION['usuario'])): ?>
            <?php if ($_SESSION['usuario']->esNormal()): ?>
                <div><a
                        id="<?php echo $comentario->getPost()->getId() . "@" . $comentario->getId(); ?>"
                        style="float:right"href="index.php?controller=comentario&action=new&post=<?php echo $comentario->getPost()->getId() ?>&padre=<?php
                        echo $comentario->getId();
                        ?>" class="btn btn-default btnResponderComentario">Responder</a></div>
                <?php endif; ?><?php endif; ?>
    </div>
</div>