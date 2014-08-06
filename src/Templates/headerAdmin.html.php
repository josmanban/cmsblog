<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fundasoft</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>

    </head>
    <body>
        <nav class="navbar navbar-default navbar-inverse navbar-fixed-top" 

             role="navigation">
            <div class="">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>  
                    <a class="navbar-brand" href="index.php?controller=pagina&action=admin"><?php echo SITE_NAME . ' - admin' ?></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav pull-right" id="dashboard-navbar-ul">  
                        <li>
                            <a href="index.php">Inicio</a>
                                        </li>
                        <?php if (isset($_SESSION['usuario'])): ?>

                            <?php if ($_SESSION['usuario']->esAdministrador()): ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Usuarios<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="index.php?controller=usuario&action=new">Crear</a>
                                        </li>
                                        <li>
                                            <a href="index.php?controller=usuario&action=index">Ver/Editar</a>
                                        </li>
                                    </ul>                                        
                                </li>
                            <?php endif; ?>
                            <?php if ($_SESSION['usuario']->esAdministrador()): ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Personas<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="index.php?controller=persona&action=new">Crear</a>
                                        </li>
                                        <li>
                                            <a href="index.php?controller=persona&action=index">Ver/Editar</a>
                                        </li>
                                    </ul>                                        
                                </li>
                            <?php endif; ?>
                            <?php if ($_SESSION['usuario']->esPublicador()): ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Articulos<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="index.php?controller=articulo&action=new">Crear articulo</a>
                                        </li>
                                        <li>
                                            <a href="index.php?controller=articulo&action=index">Ver/Editar</a>
                                        </li>
                                    </ul>                                        
                                </li>
                            <?php endif; ?>
                            <?php if ($_SESSION['usuario']->esAdministrador()): ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Proyectos<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="index.php?controller=proyecto&action=new">Crear proyecto</a>
                                        </li>

                                        <li>
                                            <a href="index.php?controller=proyecto&action=index">Ver/Editar Proyecto</a>
                                        </li>
                                        <li>
                                            <a href="index.php?controller=inscripcionProyecto&action=new">Inscribir a proyecto</a>
                                        </li>
                                        <li>
                                            <a href="index.php?controller=inscripcionProyecto&action=index">Ver/Editar Inscripciones Proyectos</a>
                                        </li>
                                    </ul>                                        
                                </li>
                            <?php endif; ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                                    <?php echo $_SESSION['usuario']->getNombre() ?> <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="index.php?controller=usuario&action=edit&id=<?php
                                        echo $_SESSION['usuario']->getId();
                                        ?>">Editar datos de la cuenta</a>
                                    </li>
                                    <li><a href="index.php?controller=perfil&action=show&id=<?php
                                        $_SESSION['usuario']->getPerfil()->getId();
                                        ;
                                        ?>">Perfil</a></li>
                                    <li><a href="index.php?controller=persona&action=show">Datos personales</a></li>
                                    <li class="divider"></li>                                    
                                    <li>
                                        <a href="index.php?controller=pagina&action=admin">Staff</a>
                                    </li>
                                    <li class="divider"></li>                                    
                                    <li>
                                        <a href="index.php?controller=usuario&action=logout">Cerrar session</a>
                                    </li>                                    
                                </ul>
                            </li>
                            <li>
                                <img class="avatar-navMenu img-rounded " src="<?php
                                if (!is_null($_SESSION['usuario']->getPerfil()))
                                    echo $_SESSION['usuario']->getPerfil()->getAvatar();
                                ?>" alt="">
                            </li>                     
                        <?php endif; ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div id="wrapper" class="container">

            <div class="row">
