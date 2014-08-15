
<?php
isset($_SESSION['admin']) && $_SESSION['admin'] == true ? require_once HEADER_ADMIN : require_once HEADER;
require_once CONTENT_ONE_COLUMN;
?>
<div>
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
    <table class="table table-hover table-responsive  table-condensed">
        <thead class="">
        <th>
            De
        </th>
        <th>
            Para
        </th>
        <th>
            Asunto
        </th>

        <th>
            Fecha hora
        </th>       
        <th></th>

        </thead>

        <?php foreach ($mensajes as $mensaje) : ?>

            <tr class="<?php
            if (!$mensaje->getLeido())
                echo 'info';
            ?>" onclick="document.location = 'index.php?controller=mensaje&action=show&id=<?php
                       echo $mensaje->getId();
                       ?>';" >

                <td><?php
                    echo $mensaje->getEmisor()->getNombre();
                    ?></td>
                <td><?php
                    echo $mensaje->getReceptor()->getNombre();
                    ?>
                </td>
                <td><strong><?php
                        if (!is_null($mensaje->getPadre()))
                            echo 'RE:';
                        echo $mensaje->getAsunto();
                        ?></strong>
                </td>

                <td><?php
                    echo $mensaje->getFechaHora()->format('d-m-Y H:s');
                    ?>
                </td>
                <td>
                    <a class="btn btn-success" href="index.php?controller=mensaje&action=new&res=<?php
                    echo $mensaje->getId();
                    ?>">Responder</a>                   
                </td>           

            </tr>        <?php endforeach; ?>
    </table>


</div>


<?php
require_once PAGINATOR;

require_once FOOTER_ONE_COLUMN;
?>
