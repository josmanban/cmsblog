<?php
require_once HEADER;
require_once CONTENT;
?>
<div>
    <h2>Nuevo mensaje

    </h2>
    <form role="form" method="POST" action="index.php?controller=mensaje&action=create">
        <?php
        require_once MENSAJE_FORM;
        ?>
        <button type="submit" class="btn btn-primary">Aceptar</button>
    </form>
</div>


<?php
require_once MENSAJES;
require_once ASIDE;
require_once FOOTER;
?>

