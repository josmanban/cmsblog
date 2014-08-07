<?php
require_once HEADER_ADMIN;
require_once CONTENT;
?>
<div>
    <h2>Proyectos</h2>
    <table class="table table-hover table-responsive table-striped table-condensed">
        <thead class="">
        <th>
            Id
        </th>

        <th>
            Nombre
        </th>

        <th>
            Descripcion
        </th>
        <th>
            Estado
        </th>
        <th>
            Tipo
        </th>
        <th>
            Cupo
        </th>
        <th>
            Cupo restante
        </th>
        <th>
            Acción
        </th>      
        </thead>

        <?php foreach ($proyectos as $proyecto) : ?>
            <tr>
                <td>
                    <?php echo $proyecto->getId(); ?>
                </td>
                <td>
                    <?php echo $proyecto->getTitulo(); ?>
                </td>
                <td>
                    <?php echo $proyecto->getResumen(); ?>
                </td>
                <td>
                    <?php echo $proyecto->getEstado()->getNombre(); ?>
                </td>
                <td>
                    <?php echo $proyecto->getTipo()->getNombre(); ?>
                </td>
                <td>
                    <?php echo $proyecto->getCupo(); ?>
                </td>
                <td>

                </td>
                <td>
                    <a class="btn btn-success" href="index.php?controller=proyecto&action=edit&id=<?php echo $proyecto->getId(); ?>">
                        Editar
                    </a>
                    <a class="btn btn-danger" href="#">
                        Eliminar
                    </a>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
</div>





<?php
require_once PAGINATOR;
require_once MENSAJES;
require_once ASIDE;
require_once FOOTER;
?>
