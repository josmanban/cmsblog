
<?php
require_once HEADER_ADMIN;
require_once CONTENT_ONE_COLUMN;
?>
<div>
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="index.php?controller=mensaje&action=recibidos">Recibidos</a></li>
        <li><a href="index.php?controller=mensaje&action=enviados">Enviados</a></li>
        <li><a href="index.php?controller=mensaje&action=papelera">Papelera</a></li>
    </ul>
    <table class="table table-hover table-responsive  table-condensed">
        <thead class="">
        <th>
            De
        </th>
        <th>
            Asunto
        </th>

        <th>
            Fecha hora
        </th>       

        </thead>

        <?php foreach ($mensajes as $mensaje) : ?>

            <tr class="<?php
            if ($mensaje->getLeido())
                echo 'info';
            ?>">
                <td><?php
                    echo $mensaje->getEmisor()->getNombre();
                    ?></td>
                <td><?php
                    echo $mensaje->getAsuto();
                    ?>
                </td>
                <td><?php
                    echo $mensaje->getFechaHora()->format('d-m-Y H:s');
                    ?>
                </td>
                <td>
                    <a class="btn btn-primary" href="index.php?controller=mensaje&action=show&id=<?php
                       echo $mensaje->getId();
                       ?>">Abrir</a>
                </td>

            </tr>        <?php endforeach; ?>
    </table>


</div>


<?php
require_once PAGINATOR;
require_once MENSAJES;
require_once FOOTER_ONE_COLUMN;
?>
