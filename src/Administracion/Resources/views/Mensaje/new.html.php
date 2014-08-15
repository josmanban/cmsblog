<?php
require_once HEADER;
require_once CONTENT;
?>
<h1></h1>
<ul class="nav nav-tabs" role="tablist">
    <li <?php
    if (isset($tab) && $tab == 'recibidos')
        echo "class='active'";
    ?>><a href="index.php?controller=mensaje&action=recibidos">Recibidos</a></li>
    <li <?php
    if (isset($tab) && $tab == 'enviados')
        echo "class='active'";
    ?>><a href="index.php?controller=mensaje&action=enviados">Enviados</a></li>
    <li <?php
    if (isset($tab) && $tab == 'papelera')
        echo "class='active'";
    ?>><a href="index.php?controller=mensaje&action=papelera">Papelera</a></li>
    <a class="btn btn-success" href="index.php?controller=mensaje&action=new">Redactar</a>

</ul>
<?php require_once MENSAJES; ?>
<div>

    <form role="form" method="POST" action="index.php?controller=mensaje&action=create">
        <?php
        require_once MENSAJE_FORM;
        ?>
        <button type="submit" class="btn btn-primary pull-right">Aceptar</button>
    </form>
</div>


<?php

require_once ASIDE;
require_once FOOTER;
?>

