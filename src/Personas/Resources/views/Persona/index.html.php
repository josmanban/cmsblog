
<?php
require_once HEADER_ADMIN;
require_once CONTENT;
?>
<div>
    <h2>Personas</h2>
    <?php require_once MENSAJES;?>
    <table class="table table-hover table-responsive table-striped table-condensed">
        <thead class="">
        <th>
            Foto
        </th>
        <th>
            Id
        </th>
        <th>
            Apellido, Nombre
        </th>
        <th>
            Usuario
        </th>
        <th>
            Fecha nacimiento
        </th>
        <th>
            Lugar nacimiento
        </th>
        <th>
            Documento
        </th>  
        <th>
            Estado
        </th>  
        <th>
            Acción
        </th>      
        </thead>

        <?php foreach ($personas as $persona) : ?>
            <tr>
                <td>
                    <img src="<?php 
                    echo $persona->getUsuario()->getPerfil()->getAvatar() ?>" class="img-rounded avatar-table" />
                </td>
                <td>
                    <?php echo $persona->getId(); ?>
                </td>
                <td>
                    <?php echo $persona->getApellido() . ', ' . $persona->getNombre(); ?>
                </td>
                <td>
                    <?php echo $persona->getUsuario()->getNombre(); ?>
                </td>
                <td>
                    <?php echo $persona->getFechaNacimiento()->format('d-m-Y'); ?>
                </td>
                <td>
                    <?php
                    echo $persona->getLugarNacimiento();
                    ?>
                </td>
                <td>
                    <?php
                    echo $persona->getTipoDocumento()->getNombre() . ': ' . $persona->getNumDocumento();
                    ?>
                </td>
                <td>
                    <?php echo $persona->getEstado()->getNombre(); ?>
                </td>

                <td>
                    <a class="btn btn-success" href="index.php?controller=persona&action=edit&id=<?php echo $persona->getId(); ?>">
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

require_once ASIDE;
require_once FOOTER;
?>
