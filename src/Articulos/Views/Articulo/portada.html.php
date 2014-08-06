
<?php
require_once HEADER;
require_once CONTENT;
?>
<div>
    <?php foreach ($articulos as $articulo) : ?>
        <?php require ARTICULO_MINIMAL; ?>
    <?php endforeach; ?>
</div>

<?php
require_once ALTERNATIVE_PAGINATOR;
require_once MENSAJES;
require_once FOOTER_ONE_COLUMN;
?>
