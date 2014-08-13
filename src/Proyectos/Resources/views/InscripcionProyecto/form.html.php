
<input type="hidden" value="<?php
if (isset($inscripcionProyecto))
    echo $inscripcionProyecto->getId();
else
    echo '-1';
?>" name="id"> 

<div class="form-group">
    <label>Proyecto:</label>
    <select class="form-control" name="proyecto" >
        <?php foreach ($proyectos as $proyecto): ?>
            <option value="<?php echo $proyecto->getId() ?>"
            <?php
            if (isset($inscripcionProyecto)) {
                if ($inscripcionProyecto->getProyecto()->getId() == $proyecto->getId())
                    echo " selected ";
            }
            ?>
                    ><?php echo $proyecto->getTitulo(); ?></option>
                <?php endforeach; ?>     
    </select>
</div>

<div class="form-group">
    <label>Rol:</label>
    <select class="form-control" name="rol" >

        <?php foreach ($roles as $rol): ?>
            <option value="<?php echo $rol->getId() ?>"
            <?php
            if (isset($inscripcionProyecto)) {
                if ($inscripcionProyecto->getRol()->getId() == $rol->getId())
                    echo " selected ";
            }
            ?>
                    ><?php echo $rol->getNombre(); ?></option>
                <?php endforeach; ?>     
    </select>
</div>


<div class="form-group">
    <label>Persona:</label>
    <select class="form-control" name="persona" >

        <?php foreach ($personas as $persona): ?>
            <option value="<?php echo $persona->getId() ?>"
            <?php
            if (isset($inscripcionProyecto)) {
                if ($inscripcionProyecto->getPersona()->getId() == $persona->getId())
                    echo " selected ";
            }
            ?>
                    >
                        <?php
                        echo $persona->getApellidoNombre();
                        ?></option>
        <?php endforeach; ?>     
    </select>
</div>

<div class="form-group">
    <label>Estado:</label>
    <select class="form-control" name="estado" >
        <?php foreach ($estados as $estado): ?>
            <option value="<?php echo $estado->getId(); ?>"
            <?php
            if (isset($inscripcionProyecto)) {
                if ($inscripcionProyecto->getEstado()->getId() == $estado->getId())
                    echo " selected ";
            }
            ?>>
                        <?php echo $estado->getNombre(); ?>
            </option>            
        <?php endforeach; ?>            
    </select>          
</div>



<div class="form-group">
    <label>Fecha inscripcion:</label>              
    <input class="form-control" type="text" name="fechaInscripcion" required disabled="true"
           value="<?php
           if (isset($inscripcionProyecto))
               echo $inscripcionProyecto->getFechaInscripcion()->format('d-m-Y');
           else
               echo (new DateTime())->format('d-m-Y');
           ?>">          
</div>  
<div class="form-group">
    <label>Descripción actividad:</label>
    <textarea class="ckeditor form-control" type="text" name="descripcionActividad" required><?php
        if (isset($inscripcionProyecto))
            echo $inscripcionProyecto->getDescripcionActividad();
        ?></textarea>          
</div>    


