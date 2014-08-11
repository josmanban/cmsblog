<form role="form" method="POST" action="index.php?controller=proyecto&action=create" enctype="multipart/form-data">
     <input type="hidden" value="-1" name="id">     
     
     <div class="form-group">
        <label>Nombre:</label>
        <input class="form-control" type="text" name="titulo" required>          
    </div>   
    <div class="form-group">
        <label>Descripci&oacute;n:</label>
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
                <option value="<?php $estado->getId(); ?>">
                    <?php echo $estado->getNombre(); ?>
                </option>            
            <?php endforeach; ?>            
        </select>          
    </div>
    
     <div class="form-group">
         <label>Codename:</label>
         <input class="form-control" type="text" name="codename">         
     </div>
     <div class="form-group">
         <label>Versi&oacute;n:</label>
         <input class="form-control" type="text" name="version">         
     </div>
     <div class="form-group">
         <label>Fecha inicio:</label>
         <input class="form-control" type="text" name="fechaInicio">         
     </div>
     
     
    
    <div class="form-group">
        <label>Duracion meses:</label>
        <input type="number" class="form-control" name="duracionMeses" required> 
    </div>
     
    <div class="form-group">
        <label>Cupo:</label>
        <input type="text" class="form-control" name="cupo" required> 
    </div>

    <div class="form-group">
        <label>Tipo:</label>
        <select class="form-control" name="tipo" >
            <?php foreach ($tipos as $tipo): ?>
                <option value="<?php echo $tipo->getId() ?>" ><?php echo $tipo->getNombre(); ?></option>
            <?php endforeach; ?>     
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Aceptar</button>
    
       
            <a href="index.php?controller=proyecto&action=index" class="btn btn-default">Cancelar</a>
       

</form>
