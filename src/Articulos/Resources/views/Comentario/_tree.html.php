<li>    
    <?php
    require COMENTARIO_SHOW;
    ?>
    <ul>
        <?php foreach ($comentario->getHijos() as $comentario): ?>
            <?php require COMENTARIO_SHOW; ?>
        <?php endforeach; ?>
    </ul>
</li>

