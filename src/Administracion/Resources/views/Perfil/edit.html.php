<?php
isset($_SESSION['admin']) && $_SESSION['admin'] == true ? require_once HEADER_ADMIN : require_once HEADER;
require_once CONTENT;
?>

<div>
    <h2>Editar datos cuenta</h2>
    <?php
    require_once MENSAJES;
    require_once PERFIL_EDIT_FORM;
    ?>
</div>

<?php
require_once MENSAJES;
require_once ASIDE;
require_once FOOTER;
?>


