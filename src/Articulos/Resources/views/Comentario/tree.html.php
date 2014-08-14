<?php if ($conId): ?>
    <div id='commentsTree'><ul class='list-unstyled'>
        <?php else: ?>
            <ul>
            <?php endif; ?>
        
                <?php foreach ($comentarios as $comentario): ?>
                    <li>
                        <?php require COMENTARIO_SHOW; ?>
                        <?php
                        Librerias\View::render(
                                COMENTARIO_TREE, array(
                            'comentarios' => $comentario->getHijos(),
                            'conId' => false,
                        ));
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php
            if ($conId)
                echo "</div>";
            ?>
