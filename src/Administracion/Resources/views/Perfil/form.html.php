
<div class="form-group">
    <label>Avatar actual:</label>
    <img src="<?php
    if (isset($perfil) && !empty($perfil->getAvatar()))
        echo $perfil->getAvatar();
    else
        echo USER_DEFAULT_AVATAR;
    ?>" class="img-rounded img-thumbnail" width="100" />          
</div>
<div class="form-group">
    <label>Avatar nuevo</label>    
    <input type="file"class="form-control" name="avatar"/>    
</div>

<div class="form-group">
    <label>Descripcion</label>    
    <textarea class="form-control" row="40" name="descripcion" value="<?php
    if (isset($perfil))
        echo $perfil->getDescripcion();
    ?>" ></textarea>
</div>