<li>
    <?php require COMENTARIO_SHOW; ?>
    <?php foreach ($comentario->getHijos() as $comentario): ?>
        <ul style="list-style: none">
            <?php require COMENTARIO_SHOW_TREE; ?>
        </ul>
    <?php endforeach; ?>


</li>