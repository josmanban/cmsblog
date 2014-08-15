
<?php
require_once HEADER_ADMIN;
require_once CONTENT_ONE_COLUMN;
?>
<div>
    <h2>Perfiles</h2>
    <?php require_once MENSAJES;?>
    <table class="table table-hover table-responsive table-striped table-condensed">
        <thead class="">
        <th>
            Avatar
        </th>
        <th>
            Id
        </th>
        <th>
            Usuario
        </th>        
        <th>
            Descripcion
        </th>      
        </thead>

        <?php foreach ($perfiles as $perfil) : ?>
            <tr>
                <td>
                    <?php echo $perfil->getAvatar(); ?>
                </td>
                <td>
                    <?php echo $perfil->getId(); ?>
                </td>
                <td>
                    <?php echo $perfil->getUsuario()->getNombre(); ?>
                </td>
                <td>
                    <?php echo $perfil->getDescripcion();?>
                </td>

                <td>
                    <a class="btn btn-success" href="index.php?controller=perfil&action=edit&id=<?php echo $perfil->getId(); ?>">
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
