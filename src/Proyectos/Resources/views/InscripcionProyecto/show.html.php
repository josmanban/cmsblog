<?php

isset($_SESSION['admin']) && $_SESSION['admin'] == true ? require_once HEADER_ADMIN : require_once HEADER;
require_once CONTENT;
?>

<h2>
    Inscripci&oacute;n proyecto
</h2>
<?php

require_once INSCRIPCION_PROYECTO_PAGE;




require_once MENSAJES;
require_once ASIDE;
require_once FOOTER;
?>
