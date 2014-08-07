<?php
require_once HEADER;
require_once CONTENT;
?>


<?php foreach ($proyectos as $proyecto): ?>
    <div class="col-md-4">
        <?php require PROYECTO_MINIMAL; ?>
    </div>
<?php endforeach; ?>          









<?php
require_once PAGINATOR;
require_once MENSAJES;
require_once ASIDE;
require_once FOOTER;
?>
