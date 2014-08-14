<div class="modal fade" id="modalResponderCommentario">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Responder comentario</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="responderComentarioPadre">
                <input type="hidden" id="responderComentarioPadre">
                <textarea  class="form-control" id="responderComentarioTexto"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="responderComentarioSubmit">Aceptar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    window.onload = function() {

        document.getElementById('newCommentForm').onsubmit = function() {
            var post = this.post.value;
            var padre = this.padre.value;
            var texto = CKEDITOR.instances.newCommentFormTexto.getData();
            addComment(post, padre, texto);
            reloadCommentTree(post);
            return false;
        };



        CKEDITOR.replace('responderComentarioTexto');
        recargarEventosArbolComentarios();

    };

    function recargarEventosArbolComentarios() {
        var btnRespuestaComentario = document.getElementsByClassName('btnResponderComentario');
        for (var i = 0; i < btnRespuestaComentario.length; i++) {
            btnRespuestaComentario[i].onclick = function() {
                $('#modalResponderCommentario').modal('show');
                var data = this.id.split('@');
                var post = data[0];
                var padre = data[1];
                document.getElementById("responderComentarioSubmit").onclick = function() {
                    //alert(post + "-" + CKEDITOR.instances.responderComentarioTexto.getData())
                    addComment(post, padre, CKEDITOR.instances.responderComentarioTexto.getData());
                    $('#modalResponderCommentario').modal('hide');
                    reloadCommentTree(post);
                };
                return false;
            };
        }
    }

    function addComment(post, padre, texto) {
        $.ajax({
            url: "index.php?controller=comentario&action=create",
            data: {
                post: post,
                padre: padre,
                texto: texto,
            },
            method: "POST",
            dataType: "JSON",
            error: function() {
                alert("Error al procesar la solicitud.\nIntentalo mas tarde");
            },
            success: function(data) {
                if (data.mensaje) {
                    //alert(JSON.stringify(data.mensaje));
                    //reloadCommentTree(post);
                }
                if (data.errores) {
                    alert(JSON.stringify(data.errores));
                }
            }
        });
    }
    function reloadCommentTree(idPost) {
        $("#commentsTree").load("index.php?controller=comentario&action=tree&id=" + idPost, function() {
            recargarEventosArbolComentarios();
        });

        // return false;
    }
</script>
