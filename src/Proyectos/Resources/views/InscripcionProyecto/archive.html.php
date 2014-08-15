<?php
isset($_SESSION['admin']) && $_SESSION['admin'] == true ? require_once HEADER_ADMIN : require_once HEADER;
require_once CONTENT;
?>


<?php foreach ($inscripcionesProyecto as $inscripcionProyecto): ?>
    <div class="col-md-4">
        <?php require INSCRIPCION_PROYECTO_MINIMAL; ?>
    </div>
<?php endforeach; ?>  



<?php

require_once MENSAJES;
require_once ASIDE;
require_once FOOTER;
?>
