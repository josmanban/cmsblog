<form role="form" method="POST" action="index.php?controller=articulo&action=update" enctype="multipart/form-data">
    <input class="hidden" type="text" name="id" value="
           <?php echo $articulo->getId(); ?>">
    <div class="form-group">
        <label>Titulo:</label>
        <input class="form-control" type="text" name="titulo" required
               value="<?php echo $articulo->getTitulo(); ?>"
               >          
    </div>    
    <div class="form-group">
        <label>Texto:</label>
        <textarea row="40" class="ckeditor form-control" type="text" name="texto" required><?php echo $articulo->getTexto(); ?></textarea>          
    </div>

    <div class="form-group">
        <label>Imagen actual:</label>
        <img src="<?php echo $articulo->getImagen(); ?>" class="img-rounded img-thumbnail" width="100" />          
    </div>
    <div class="form-group">
        <label>Imagen nueva:</label>
        <input class="form-control" type="file" name="imagen">
    </div>
    <div class="form-group">
        <label>Estado:</label>
        <select class="form-control" name="estado" >
<?php foreach ($estados as $estado): ?>
                <option value="<?php echo $estado->getId(); ?>"
                <?php
                if ($articulo->getEstado()->getId() == $estado->getId())
                    echo "selected";
                ?>
                        >
                <?php echo $estado->getNombre(); ?>
                </option>            
                        <?php endforeach; ?>            
        </select>          
    </div>
    <div class="form-group">
        <label>Categorías:</label>
<?php foreach ($categorias as $categoria): ?>
            <ul class="list-unstyled">
                <li>  <label>
                        <input type="checkbox"  value="<?php echo $categoria->getId() ?>" name="categorias[]"
    <?php foreach ($articulo->getCategorias() as $categoriaArticulo): ?>
                            <?php if ($categoria->getId() == $categoriaArticulo->getId()): ?>
                                       checked="true"
                            <?php endif; ?>
                               <?php endforeach; ?>>
                               <?php echo $categoria->getNombre(); ?></label></li>
            </ul>
                    <?php endforeach; ?>          
    </div>

    <button type="submit" class="btn btn-primary">Aceptar</button>
    <a href="index.php?controller=articulo&action=index" class="btn btn-default">Cancelar</a>
</form>
