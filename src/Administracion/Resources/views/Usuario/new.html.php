<?php
isset($_SESSION['admin']) && $_SESSION['admin'] == true ? require_once HEADER_ADMIN : require_once HEADER;
require_once CONTENT;
?>
<div>
    <h2>Registrarse


    </h2>
    <?php
    require_once MENSAJES;
    require_once USUARIO_NEW_FORM;
    ?>
</div>


<?php
require_once ASIDE;
require_once FOOTER;
?>


