<form role="form" method="POST" action="index.php?controller=proyecto&action=update" enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $proyecto->getId(); ?>" name="id">         

    <div class="form-group">
        <label>Nombre:</label>
        <input class="form-control" type="text" name="titulo" required 
               value="<?php echo $proyecto->getTitulo(); ?>">          
    </div>
    <div class="form-group">
        <label>Descripci&oacute;n:</label>
        <textarea class="ckeditor form-control" type="text" name="texto" required                            
                  ><?php echo $proyecto->getTexto(); ?></textarea>          
    </div>

    <div class="form-group">
        <label>Imagen actual:</label>
        <img src="<?php echo $proyecto->getImagen(); ?>" class="img-rounded img-thumbnail" width="100" />          
    </div>
    <div class="form-group">
        <label>Imagen:</label>
        <input class="form-control" type="file" name="imagen">
    </div>

    <div class="form-group">
        <label>Estado:</label>
        <select class="form-control" name="estado" >
            <?php foreach ($estados as $estado): ?>
                <option value="<?php echo $estado->getId(); ?>"
                <?php
                if ($proyecto->getEstado()->getId() == $estado->getId())
                    echo "selected"
                    ?>
                        >
                            <?php echo $estado->getNombre(); ?>
                </option>            
            <?php endforeach; ?>            
        </select>          
    </div>
   
    <div class="form-group">
        <label>Codename:</label>
        <input type="text" class="form-control" name="codename"
               value="<?php echo $proyecto->getCodename(); ?>"          
               >          
    </div>

    <div class="form-group">
        <label>Version:</label>
        <input type="text" class="form-control" name="version"
               value="<?php echo $proyecto->getVersion(); ?>"          
               >          
    </div>

    <div class="form-group">
        <label>Fecha inicio:</label>
        <input type="text" class="form-control" name="fechaInicio" required
               value="<?php
               if (is_object($proyecto->getFechaInicio()))
                   echo $proyecto->getFechaInicio()->format('d-m-Y');
               else
                   echo $proyecto->getFechaInicio();
               ?>">          
    </div>

    <div class="form-group">
        <label>Duracion meses:</label>
        <input type="text" class="form-control" name="duracionMeses"
               value="<?php echo $proyecto->getDuracionMeses(); ?>"          
               >          
    </div>

    <div class="form-group">
        <label>Cupo:</label>
        <input type="text" class="form-control" name="cupo" required
               value="<?php echo $proyecto->getCupo(); ?>">          
    </div>


    <div class="form-group">
        <label>Tipo:</label>
        <select class="form-control" name="tipo" >
            <?php foreach ($tipos as $tipo): ?>
                <option value="<?php echo $tipo->getId() ?>" 
                <?php
                if ($proyecto->getTipo()->getId() == $tipo->getId())
                    echo "selected"
                    ?>

                        ><?php echo $tipo->getNombre(); ?></option>
                    <?php endforeach; ?>     
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Aceptar</button>
    <a href="index.php?controller=proyecto&action=index" class="btn btn-default">Cancelar</a>
</form>
