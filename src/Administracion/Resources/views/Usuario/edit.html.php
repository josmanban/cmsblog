<?php
isset($_SESSION['usuario'])&& $_SESSION['usuario']->esAdministrador()?require_once HEADER_ADMIN:  require_once HEADER;
require_once CONTENT;
?>

<div>
    <h2>Editar datos cuenta</h2>
    <?php
    require_once MENSAJES;
    require_once USUARIO_EDIT_FORM;
    ?>
</div>

<?php

require_once ASIDE;
require_once FOOTER;
?>


