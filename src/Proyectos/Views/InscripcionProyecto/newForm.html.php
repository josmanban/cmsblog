<form role="form" method="POST" action="index.php?controller=inscripcionProyecto&action=create">
    <input type="hidden" value="-1" name="id"> 
    <div class="form-group">
        <label>Proyecto:</label>
        <select class="form-control" name="proyecto" >
            <?php foreach ($proyectos as $proyecto): ?>
                <option value="<?php echo $proyecto->getId() ?>" ><?php echo $proyecto->getTitulo(); ?></option>
            <?php endforeach; ?>     
        </select>
    </div>

    <div class="form-group">
        <label>Rol:</label>
        <select class="form-control" name="rol" >

            <?php foreach ($roles as $rol): ?>
                <option value="<?php echo $rol->getId() ?>" ><?php echo $rol->getNombre(); ?></option>
            <?php endforeach; ?>     
        </select>
    </div>


    <div class="form-group">
        <label>Persona:</label>
        <select class="form-control" name="persona" >

            <?php foreach ($personas as $persona): ?>
                <option value="<?php echo $persona->getId() ?>" >
                    <?php
                    echo $persona->getApellidoNombre();
                    ?></option>
            <?php endforeach; ?>     
        </select>
    </div>



    <div class="form-group">
        <label>Fecha inscripcion:</label>
        <input class="form-control" type="text" name="fechaInscripcion" required disabled="true"
               value="<?php echo (new DateTime())->format('d-m-Y') ?>">          
    </div>
    <div class="form-group">
        <label>Fecha finalizacion:</label>
        <input class="form-control" type="text" name="fechaFinalizacion" 
               >          
    </div>
    <div class="form-group">
        <label>Descripción actividad:</label>
        <textarea class="form-control" type="text" name="descripcionActividad" required></textarea>          
    </div>

    <div class="form-group">
        <label>Estado:</label>
        <select class="form-control" name="estado" >
            <?php foreach ($estados as $estado): ?>
                <option value="<?php $estado->getId(); ?>">
                    <?php echo $estado->getNombre(); ?>
                </option>            
            <?php endforeach; ?>            
        </select>          
    </div>


    <button type="submit" class="btn btn-primary">Aceptar</button>


    <a href="index.php?controller=inscripcionProyecto&action=index" class="btn btn-default">Cancelar</a>


</form>
