<?php
require_once HEADER;
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
