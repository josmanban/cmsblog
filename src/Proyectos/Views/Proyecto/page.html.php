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


<style>
    .coments-container>ul{
        padding-left: 0px;
    }
</style>
<article class="coments-container">
    <header>
        <h3>
            Log:
        </h3>
    </header>
    <?php
    $proyectoController = new Proyectos\Controller\ProyectoController();
    $proyectoController->getCommentsBoxAction($proyecto->getId());
    ?>    
</article>

