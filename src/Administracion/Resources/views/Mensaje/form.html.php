
<input
    type="hidden" name="padre" value="<?php
    if (isset($padre))
        echo $padre->getId();
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
    <?php if (isset($padre)): ?>
        <input type="hidden" name="receptor" value="<?php echo $padre->getEmisor()->getNombre() ?>">
        <input class="form-control" type="text" disabled="disabled" value="<?php echo $padre->getEmisor()->getNombre() ?>"    >
    <?php else : ?>
        <input class="form-control" type="text" name="receptor" required>          
    <?php endif; ?>
</div>
<div class="form-group">
    <label>Asunto:</label>
    <?php if (isset($padre)): ?>
        <input type="hidden" name="asunto" value='<?php echo $padre->getAsunto() ?>'>
        <input class="form-control" type="text" disabled="disabled"  value="RE:<?php echo $padre->getAsunto() ?>"   >
    <?php else : ?>
        <input class="form-control" type="text" name="asunto" required>         
    <?php endif; ?>


</div>
<div class="form-group">
    <label>Mensaje:</label>

    <textarea class="ckeditor form-control" type="text" name="texto" required></textarea>         

</div>

