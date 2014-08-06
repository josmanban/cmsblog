
<?php
require_once HEADER_ADMIN;
require_once CONTENT_ONE_COLUMN;
?>
<div>
    <h2>Usuarios</h2>
    <table class="table table-hover table-responsive table-striped table-condensed">
        <thead class="">
        <th>
            Id
        </th>

        <th>
            Nombre
        </th>
        <th>
            Password
        </th>
        <th>
            Email
        </th>
        <th>
            Roles
        </th>  
        
        <th>
            Estado
        </th>
        <th>
            Acción
        </th>      
        </thead>

        <?php foreach ($usuarios as $usuario) : ?>
            <tr>
                <td>
                    <?php echo $usuario->getId(); ?>
                </td>
                <td>
                    <?php echo $usuario->getNombre(); ?>
                </td>
                <td>
                    <?php echo $usuario->getPassword(); ?>
                </td>
                <td>
                    <?php echo $usuario->getEmail(); ?>
                </td>
                <td>
                    <?php
                    foreach ($usuario->getRoles() as $rol)
                        echo $rol->getNombre() . ', ';
                    ?>
                </td>
                                <td>
                    <?php echo $usuario->getEstado()->getNombre(); ?>
                </td>

                <td>
                    <a class="btn btn-success" href="index.php?controller=usuario&action=edit&id=<?php echo $usuario->getId(); ?>">
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
require_once FOOTER_ONE_COLUMN;
?>
