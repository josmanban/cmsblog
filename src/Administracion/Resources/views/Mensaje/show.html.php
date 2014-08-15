<?php
isset($_SESSION['admin']) && $_SESSION['admin'] == true ? require_once HEADER_ADMIN : require_once HEADER;
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
    <br>
    <dl class="dl-horizontal">
        <dt>De:
        </dt>
        <dd>  
            <?php echo $mensaje->getEmisor()->getNombre(); ?>
        </dd>
        <dt>
        Para:</dt>
        <dd>
            <?php echo $mensaje->getReceptor()->getNombre(); ?>        
        </dd>
        <dt>Asunto:</dt>
        <dd><?php echo $mensaje->getAsunto(); ?></dd>
        <dt>Mensaje</dt>
        <dd><?php echo $mensaje->getTexto(); ?></dd>
        <dt></dt><dd><a class="btn btn-success" href="index.php?controller=mensaje&action=new&res=<?php echo $mensaje->getId() ?>">Responder</a></dd>
    </dl>
</div>
<?php
require_once MENSAJES;
require_once ASIDE;
require_once FOOTER;
?>

