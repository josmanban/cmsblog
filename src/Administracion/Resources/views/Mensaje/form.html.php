
<input
    type="hidden" name="padre" value="<?php
    if (isset($padre))
        echo $padre;
    else
        echo -1;
    ?>"
    >
<input
    type="hidden" name="emisor" value="<?php
    echo $_SESSION['usuario']->getId();
    ?>"
    >

<div class="form-group">
    <label>Para:</label>

    <input class="form-control" type="text" name="receptor" required>          

</div>
<div class="form-group">
    <label>Asunto:</label>

    <input class="form-control" type="text" name="asunto" required>          

</div>
<div class="form-group">
    <label>Mensaje:</label>

    <textarea class="ckeditor form-control" type="text" name="texto" required>          

</div>

