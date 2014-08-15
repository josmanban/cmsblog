<?php
isset($_SESSION['admin']) && $_SESSION['admin'] == true ? require_once HEADER_ADMIN : require_once HEADER;
require_once CONTENT;
?>


<div>
    <?php
    require_once MENSAJES;
    require ARTICULO_PAGE;
    ?>
</div>
<?php
require_once ASIDE;
require_once FOOTER;
?>
