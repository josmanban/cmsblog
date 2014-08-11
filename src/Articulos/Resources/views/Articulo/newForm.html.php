<form role="form" method="POST" action="index.php?controller=articulo&action=create" enctype="multipart/form-data" >
     <input type="hidden" value="-1" name="id"> 
    <div class="form-group">
        <label>Titulo:</label>
        <input class="form-control" type="text" name="titulo" required>          
    </div>   
    <div class="form-group">
        <label>Texto:</label>
        <textarea row="40" class="form-control" type="text" name="texto" required></textarea>          
    </div>
     
    <div class="form-group">
        <label>Imagen:</label>
        <input class="form-control" type="file" name="imagen">
    </div>
    <div class="form-group">
        <label>Estado:</label>
        <select class="form-control" name="estado" >
            <?php foreach ($estados as $estado): ?>
                <option value="<?php echo $estado->getId(); ?>">
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
                        <input type="checkbox"  value="<?php echo $categoria->getId() ?>" name="categorias[]">
                        <?php echo $categoria->getNombre(); ?></label></li>
            </ul>
        <?php endforeach; ?>          
    </div>

    <button type="submit" class="btn btn-primary">Aceptar</button>   

    <a href="index.php?controller=articulo&action=index" class="btn btn-default">Cancelar</a>


</form>
