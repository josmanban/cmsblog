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
    <a class="btn btn-success">Inscribirme</a> 
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
        <ul style="list-style: none" >
            <?php foreach ($proyecto->getComentarios() as $comentario): ?>

                <?php
                if (is_null($comentario->getPadre()))
                    require COMENTARIO_SHOW_TREE;
                ?>
            <?php endforeach; ?>
        </ul>
    </article>
<?php endif; ?>