<?php
isset($_SESSION['admin']) && $_SESSION['admin'] == true ? require_once HEADER_ADMIN : require_once HEADER;
require_once CONTENT;
?>
<div>
    <h2>Inscripciones a Proyectos</h2>
    <?php require_once MENSAJES; ?>
    <table class="table table-hover table-responsive table-striped table-condensed">
        <thead class="">
        <th>
            Id
        </th>

        <th>
            Apellido, nombre
        </th>

        <th>
            Proyecto
        </th>
        <th>
            Rol
        </th>
        <th>
            Fecha inscripcion
        </th>
        <th>
            Duración Meses
        </th>
        <th>
            Estado
        </th>
        <th>

        </th>      
        </thead>

        <?php foreach ($inscripcionesProyecto as $inscripcionProyecto) : ?>
            <tr>
                <td>
                    <?php echo $inscripcionProyecto->getId(); ?>
                </td>
                <td>
                    <?php echo $inscripcionProyecto->getPersona()->getApellidoNombre(); ?>
                </td>
                <td>
                    <?php echo $inscripcionProyecto->getProyecto()->getTitulo(); ?>
                </td>
                <td>
                    <?php echo $inscripcionProyecto->getRol()->getNombre(); ?>
                </td>
                <td>
                    <?php echo $inscripcionProyecto->getFechaInscripcion()->format('d-m-Y'); ?>
                </td>
                <td>
                    <?php
                    echo $inscripcionProyecto->getProyecto()->getDuracionMeses();
                    ?>
                </td>
                <td>
                    <?php echo $inscripcionProyecto->getEstado()->getNombre(); ?>
                </td>
                <td>              
                    <a class="btn btn-danger" href="#">
                        Cancelar
                    </a>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
</div>





<?php
require_once PAGINATOR;

require_once ASIDE;
require_once FOOTER;
?>
