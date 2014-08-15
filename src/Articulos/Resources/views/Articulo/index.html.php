
<?php
isset($_SESSION['admin']) && $_SESSION['admin'] == true ? require_once HEADER_ADMIN : require_once HEADER;
require_once CONTENT;
?>
<div>
    <h2>Articulos</h2>
    <?php require_once MENSAJES;?>
    <table class="table table-hover table-responsive table-striped table-condensed">
        <thead class="">
        <th>
            Id
        </th>

        <th>
            Titulo
        </th>
        <th>
            Autor
        </th>
        <th>
            Categorias
        </th>
        <th>
            Fecha hora publicación
        </th>  
        <th>
            Estado
        </th>

        <th>
            Acción
        </th>      
        </thead>

        <?php foreach ($articulos as $articulo) : ?>
            <tr>
                <td>
                    <?php echo $articulo->getId(); ?>
                </td>
                <td>
                    <?php echo $articulo->getTitulo(); ?>
                </td>
                <td>
                    <?php echo $articulo->getAutor()->getNombre(); ?>
                </td>
                <td>
                    <?php
                    foreach ($articulo->getCategorias() as $categoria)
                        echo $categoria->getNombre() . ', ';
                    ?>
                </td>
                <td>
                    <?php echo $articulo->getFechaHoraPublicacion()->format('d-m-Y H:i') . 'hs'; ?>
                </td>
                <td>
                    <?php echo $articulo->getEstado()->getNombre(); ?>
                </td>

                <td>
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <?php
                        $usuario = $_SESSION['usuario'];
                        ?>
                        <?php
                        if (($usuario->esPublicador() && $articulo->getAutor()->getId() == $usuario->getId() ) || $usuario->esAdministradorArticulo() || $usuario->esAdministrador()):
                            ?>
                            <a class="btn btn-success" href="index.php?controller=articulo&action=edit&id=<?php echo $articulo->getId(); ?>">
                                Editar
                            </a>
                            <a class="btn btn-danger" href="#">
                                Eliminar
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
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
