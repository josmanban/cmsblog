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
        <script type="text/javascript" src="vendor/ckeditor/ckeditor/ckeditor.js" ></script>
        <script type="text/javascript" src="vendor/ckeditor/ckeditor/config.js"></script>
        <script>
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            //  CKEDITOR.replace('editor1');
        </script>
    </head>
    <body>   
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><?php echo SITE_NAME ?></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav pull-right ">
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="index.php?controller=articulo&action=blog">Noticias</a></li>
                        <li><a href="index.php?controller=proyecto&action=archive&tipo=desarrollo">Proyecto/Desarrollo</a></li>
                        <li><a href="index.php?controller=proyecto&action=archive&tipo=charla">Charlas</a></li>
                        <li><a href="index.php?controller=proyecto&action=archive&tipo=curso">Cursos</a></li>
                        <li><a href="index.php?controller=pagina&action=galeria">Galeria</a></li>
                        <li><a href="index.php?controller=pagina&action=nosotros">Nosotros</a></li>
                        <li><a href="index.php?controller=pagina&action=contacto">Contacto</a></li>   
                        <?php if (isset($_SESSION['usuario'])): ?>
                            <li>
                                <a href="index.php?controller=mensaje&action=recibidos">
                                    <span class="glyphicon glyphicon-comment"></span> 
                                    <?php
                                    $numMensajesNoLeidos = (new \Administracion\Controller\MensajeController())->getNumeroMensajesNoLeidos();
                                    if ($numMensajesNoLeidos > 0):
                                        ?>
                                        <span class="badge"><?php echo $numMensajesNoLeidos; ?></span>                               
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                                    <?php echo $_SESSION['usuario']->getNombre() ?> <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="index.php?controller=perfil&action=miPerfil&id=<?php
                                        echo $_SESSION['usuario']->getId();
                                        ;
                                        ?>">Mi perfil</a></li>
                                    <li>
                                        <a href="index.php?controller=usuario&action=edit&id=<?php
                                        echo $_SESSION['usuario']->getId();
                                        ?>">Editar datos de la cuenta</a>
                                    </li>                                    
                                    <li>
                                        <?php if (!is_null($_SESSION['usuario']->getPersona())): ?>
                                            <a href="index.php?controller=persona&action=edit&id=<?php
                                            echo $_SESSION['usuario']->getPersona()->getId();
                                            ?>">Editar datos personales</a>
                                           <?php else: ?>
                                            <a href="index.php?controller=persona&action=new">
                                                Completar datos personales</a>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <a href="index.php?controller=inscripcionProyecto&action=misInscripciones">Mis Inscripciones</a>
                                    </li>
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
                        <?php else : ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Invitado<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="index.php?controller=usuario&action=login">Iniciar sesion</a>
                                    </li>
                                    <li>
                                        <a href="index.php?controller=usuario&action=new">Registrarse</a>
                                    </li>

                                </ul>
                            </li>

                        <?php endif; ?>
                        <li>
                            <img class="avatar-navMenu img-rounded " src="<?php
                            if (isset($_SESSION['usuario']) && !is_null($_SESSION['usuario']->getPerfil()))
                                echo $_SESSION['usuario']->getPerfil()->getAvatar();
                            else
                                echo USER_DEFAULT_AVATAR;
                            ?>" alt="">
                        </li>

                    </ul>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>        
        <div id="wrapper" class="container" >

            <div class="row">
