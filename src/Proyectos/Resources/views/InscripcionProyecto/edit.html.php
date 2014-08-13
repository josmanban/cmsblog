<?php
require_once HEADER_ADMIN;
require_once CONTENT;
?>


<div>
    <h2>Editar Inscripción Proyecto</h2>
    <form role="form" method="POST" action="index.php?controller=inscripcionProyecto&action=update">
        <?php
        require_once INSCRIPCION_PROYECTO_FORM;
        ?>
        <button type="submit" class="btn btn-primary">Aceptar</button>

        <a href="index.php?controller=inscripcionProyecto&action=index" class="btn btn-default">Cancelar</a>
    </form>
</div>


<?php
require_once MENSAJES;
require_once ASIDE;
require_once FOOTER;
?>


