<?php if (isset($_SESSION['usuario'])): ?>
    <?php $usuario = $_SESSION['usuario'];
    ?>  

    <form role="form" class="" id="newCommentForm" method="POST" action="index.php?controller=comentario&action=create">
        <input type="hidden" name="id" value="-1">
        <input type="hidden" name="post" value="<?php echo $post->getId(); ?>">
        <input type="hidden" name="padre" value="<?php
        if (!isset($padre))
            echo -1;
        else
            echo $padre->getId();
        ?>">
        <div class="form-group">
            <!--label class="control-label">Nuevo Comentario:</label -->
            <textarea  class="form-control" id="newCommentFormTexto" name="texto"></textarea>
        </div>
        <div class="form-group right">
            <input type="submit" class="btn btn-primary pull-right"  value="Aceptar">
        </div>
        <br><br>
    </form> 
    <script>
        CKEDITOR.replace('newCommentFormTexto');
        //onsubmit="addCommentFromForm(this, event);" 
        /* function addCommentFromForm(obj, ev) {
         ev.preventDefault();
         var post = obj.post.value;
         var padre = obj.padre.value;
         var texto = CKEDITOR.instances.newCommentFormTexto.getData();
         addComment(post, padre, texto);
             
             
         }
         ;*/
    </script>
<?php else: ?>
    <div class="alert alert-warning">
        Inicia sesión para poder comentar.
    </div>
<?php endif; ?>


