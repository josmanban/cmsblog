<?php
isset($_SESSION['admin']) && $_SESSION['admin'] == true ? require_once HEADER_ADMIN : require_once HEADER;
require_once CONTENT;
?>
<h1 class="alert alert-info">
    BIENVENIDO AL ADMINISTRADOR.
</h1>
<?php
require_once MENSAJES;
require_once ASIDE;
require_once FOOTER;
?>
