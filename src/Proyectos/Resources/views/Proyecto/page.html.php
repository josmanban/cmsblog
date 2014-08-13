<style>
    .pageProjectData{
        padding-left: 0px;
        list-style: none;
    }
    .pageProjectImg{
        float:left;
        width: 200px;
        margin-bottom: 10px;
        margin-right: 10px;        

    }
    .pageProjectTitle{
        text-transform: uppercase;
    }
</style>
<script>
    window.onload = function() {

        var botonesInscripcion = document.getElementsByClassName('inscripcionAction');
        for (var i = 0; i < botonesInscripcion.length; i++) {
            botonesInscripcion[i].onclick = function() {
                var idProyecto = this.id.split("@")[1];
                $.ajax({
                    url: "index.php?controller=inscripcionProyecto&action=create",
                    method: 'POST',
                    data: {
                        proyecto: idProyecto
                    },
                    dataType: "JSON",
                    error: function() {
                        alert("Error en la solicitud.\nIntentalo mas tarde.");
                    },
                    success: function(data) {
                        if (data.mensajes) {
                            alert(data.mensajes);
                        }
                        if (data.errores) {
                            alert(JSON.stringify(data.errores));
                        }
                    }
                });
            }
        }
    }
</script>
<article>  
    <header>
        <h3 class="pageProjectTitle"> <?php echo $proyecto->getTitulo(); ?></h3>
    </header>
    <p>
        <img class="pageProjectImg img-rounded img-thumbnail" src="<?php echo $proyecto->getImagen(); ?>">

    <ul class="pageProjectData">
        <li><b>Codename:</b>
            <?php echo $proyecto->getCodename(); ?></li>
        <li><b>Version:</b>
            <?php echo $proyecto->getVersion(); ?></li>
        <li><b>Fecha inicio:</b>
            <?php echo $proyecto->getFechaInicio()->format('d-m-Y'); ?></li>
        <li><b>Duracion meses:</b>
            <?php echo $proyecto->getDuracionMeses(); ?></li>
        <li><b>Cupo:</b>
            <?php echo $proyecto->getCupo(); ?></li>
        <li><b>Descripci&oacute;n:</b>
            <?php echo $proyecto->getTexto(); ?> </li>
    </ul>
</p>

<footer>
    <a class="btn btn-info" href="index.php?controller=inscripcionProyecto&action=archive&id=<?php
    echo $proyecto->getId();
    ?>">Participantes</a>
    <a class="btn btn-success  inscripcionAction" id="proyecto@<?php echo $proyecto->getId(); ?>">Inscribirme</a> 
</footer>

</article>


<?php if (isset($_SESSION['usuario']) && ($_SESSION['usuario']->esAdministrador() || $_SESSION['usuario']->esAdministradorProyecto() || $proyecto->pertenece($_SESSION['usuario']))): ?>
    <style>
        .coments-container>ul{
            padding-left: 0px;
        }
    </style>
    <article class="coments-container">
        <header>
            <h3>
                Logs:
            </h3>
        </header>    
        <?php \Librerias\View::render(COMENTARIO_NEW_FORM, array('post' => $proyecto)) ?>
        <?php Librerias\View::render(COMENTARIO_TREE, array('comentarios' => $comentarios)); ?>
    </article>
<?php endif; ?>