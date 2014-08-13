
<ul>
    <?php foreach ($comentarios as $comentario): ?>
        <li>
            <?php require COMENTARIO_SHOW; ?>
            <?php Librerias\View::render(
                    COMENTARIO_TREE,array(
                        'comentarios'=>$comentario->getHijos()
                    ));?>
        </li>
    <?php endforeach; ?>
</ul>


