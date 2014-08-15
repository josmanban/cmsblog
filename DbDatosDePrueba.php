<?php

$em = \Librerias\Conexion::getEntityManager();
$em->getConnection()->beginTransaction(); // suspend auto-commit
try {

    $estadoActivo = $em->getRepository('Administracion\Model\Entity\Estado')->findOneBy(array(
        'nombre' => 'ACTIVO',
        'ambito' => 'ADMINISTRACION'
    ));


    $rolNormal = $em->getRepository('Administracion\Model\Entity\Rol')->findOneBy(array(
        'nombre' => 'NORMAL',
        'ambito' => 'ADMINISTRACION'
    ));

    $rolAdministrador = $em->getRepository('Administracion\Model\Entity\Rol')->findOneBy(array(
        'nombre' => 'ADMINISTRADOR',
        'ambito' => 'ADMINISTRACION'
    ));

    $rolPublicador = $em->getRepository('Administracion\Model\Entity\Rol')->findOneBy(array(
        'nombre' => 'PUBLICADOR',
        'ambito' => 'ADMINISTRACION'
    ));

    $rolAdministradorArticulo = $em->getRepository('Administracion\Model\Entity\Rol')->findOneBy(array(
        'nombre' => 'ADMINISTRADORARTICULO',
        'ambito' => 'ADMINISTRACION'
    ));

    $rolAdministradorProyecto = $em->getRepository('Administracion\Model\Entity\Rol')->findOneBy(array(
        'nombre' => 'ADMINISTRADORPROYECTO',
        'ambito' => 'ADMINISTRACION'
    ));

    $rolPublicadorProyecto = $em->getRepository('Administracion\Model\Entity\Rol')->findOneBy(array(
        'nombre' => 'PUBLICADORPROYECTO',
        'ambito' => 'ADMINISTRACION'
    ));


    $nombresAdministradores = array('josmanban', 'fundasoft');

    $tipoDocumento = $em->getRepository('Personas\Model\Entity\TipoDocumento')->findOneBy(array('nombre' => 'DNI'));
    $sexo = $em->getRepository('Personas\Model\Entity\Sexo')->findOneBy(array('nombre' => 'MASCULINO'));

    foreach ($nombresAdministradores as $nombre) {

        $usuario = new \Administracion\Model\Entity\Usuario();
        $usuario->setNombre($nombre);
        $usuario->setPassword(md5('password'));
        $usuario->setEmail($nombre . '@gmail.com');
        $usuario->setEstado($estadoActivo);

        $usuario->addRol($rolAdministrador, $rolNormal);


        $perfil = new \Administracion\Model\Entity\Perfil();
        $perfil->setAvatar(USER_DEFAULT_AVATAR);
        $perfil->setDescripcion('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean velit quam, pellentesque ac volutpat adipiscing, pharetra quis mauris. Donec ullamcorper enim non massa tempus varius. Nunc aliquam ornare lectus. Etiam porta lacinia orci dignissim cursus. Duis risus orci, viverra at iaculis a, consectetur in augue. Nullam a lobortis felis, a semper massa. In at condimentum nisi. Praesent sed risus nisl. Phasellus est nulla, egestas eget erat ut, molestie sagittis dolor. Cras nec ullamcorper odio, a porta tellus.');
        $usuario->setPerfil($perfil);
        $perfil->setUsuario($usuario);

        $persona = new Personas\Model\Entity\Persona();

        $persona->setNombre($nombre);
        $persona->setApellido('apellido');
        $persona->setFechaNacimiento(new \DateTime());
        $persona->setLugarNacimiento('Cordoba');
        $persona->setNumDocumento(count($nombre));
        $persona->setEstado($estadoActivo);
        $persona->setSexo($sexo);
        $persona->setTipoDocumento($tipoDocumento);

        $persona->setUsuario($usuario);
        $usuario->setPersona($persona);

        $em->persist($usuario);
    }

    for ($i = 0; $i < 50; $i++) {

        $usuario = new \Administracion\Model\Entity\Usuario();
        $usuario->setNombre('usuario' . $i);
        $usuario->setPassword(md5('password'));
        $usuario->setEmail('usuario' . $i . '@gmail.com');
        $usuario->setEstado($estadoActivo);

        if ($i < 10) {
            $usuario->addRol($rolNormal);
        }
        if ($i >= 10 && $i < 20) {
            $usuario->addRol($rolNormal);
            $usuario->addRol($rolPublicador);
        }
        if ($i >= 20 && $i < 30) {
            $usuario->addRol($rolNormal);
            $usuario->addRol($rolPublicador);
            $usuario->addRol($rolAdministradorArticulo);
        }
        if ($i >= 30 && $i < 40) {
            $usuario->addRol($rolNormal);
            $usuario->addRol($rolPublicadorProyecto);
        }
        if ($i >= 40 && $i < 50) {
            $usuario->addRol($rolNormal);
            $usuario->addRol($rolPublicadorProyecto);
            $usuario->addRol($rolAdministradorProyecto);
        }


        $perfil = new \Administracion\Model\Entity\Perfil();
        $perfil->setAvatar(USER_DEFAULT_AVATAR);
        $perfil->setDescripcion('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean velit quam, pellentesque ac volutpat adipiscing, pharetra quis mauris. Donec ullamcorper enim non massa tempus varius. Nunc aliquam ornare lectus. Etiam porta lacinia orci dignissim cursus. Duis risus orci, viverra at iaculis a, consectetur in augue. Nullam a lobortis felis, a semper massa. In at condimentum nisi. Praesent sed risus nisl. Phasellus est nulla, egestas eget erat ut, molestie sagittis dolor. Cras nec ullamcorper odio, a porta tellus.');
        $usuario->setPerfil($perfil);
        $perfil->setUsuario($usuario);

        $persona = new Personas\Model\Entity\Persona();

        $persona->setNombre('nombre' . $i);
        $persona->setApellido('apellido' . $i);
        $persona->setFechaNacimiento(new \DateTime());
        $persona->setLugarNacimiento('Cordoba');
        $persona->setNumDocumento($i + 100);
        $persona->setEstado($estadoActivo);
        $persona->setSexo($sexo);
        $persona->setTipoDocumento($tipoDocumento);

        $persona->setUsuario($usuario);
        $usuario->setPersona($persona);


        $em->persist($usuario);
    }

    $em->flush();



    $autor = $em->getRepository('Administracion\Model\Entity\Usuario')->findOneBy(array('nombre' => 'fundasoft'));
    $categorias = $em->getRepository('Articulos\Model\Entity\CategoriaArticulo')->findAll();
    $usuarios = $em->getRepository('Administracion\Model\Entity\Usuario')->findAll();

    $rolParticipante = $em->getRepository('Administracion\Model\Entity\Rol')->findOneBy(array('nombre' => 'participante', 'ambito' => 'proyecto'));

    $estadoAceptado = $em->getRepository('Administracion\Model\Entity\Estado')->findOneBy(array('nombre' => 'aceptado', 'ambito' => 'inscripcionproyecto'));

    for ($i = 0; $i < 50; $i++) {

        $articulo = new Articulos\Model\Entity\Articulo();
        $articulo->setAutor($autor);
        $articulo->setCategorias($categorias);
        $articulo->setEstado($estadoActivo);
        $articulo->setFechaHoraPublicacion(new \DateTime());
        $articulo->setImagen(ARTICLE_DEFAULT_IMAGE);
        $articulo->setTexto("<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean velit quam, pellentesque ac volutpat adipiscing, pharetra quis mauris. Donec ullamcorper enim non massa tempus varius. Nunc aliquam ornare lectus. Etiam porta lacinia orci dignissim cursus. Duis risus orci, viverra at iaculis a, consectetur in augue. Nullam a lobortis felis, a semper massa. In at condimentum nisi. Praesent sed risus nisl. Phasellus est nulla, egestas eget erat ut, molestie sagittis dolor. Cras nec ullamcorper odio, a porta tellus.</p>

<p>Duis eget libero et sem pretium tempor nec in leo. Nullam in consequat massa, non vulputate tortor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Morbi interdum, felis sed vestibulum bibendum, dui tellus ultrices lacus, sit amet sodales neque ipsum in ligula. Vestibulum quam ipsum, interdum non urna eget, ullamcorper commodo nisi. Vestibulum aliquam, velit quis ullamcorper laoreet, mi nibh rhoncus eros, et ultrices velit tellus non orci. Sed pellentesque sed tellus nec fermentum. Duis consectetur orci nibh, id adipiscing dui blandit vitae. Donec lacinia euismod dui eget vestibulum.</p>

<p>Sed laoreet hendrerit elit. Etiam eros augue, placerat bibendum mauris ac, malesuada pretium nulla. Sed nulla dolor, vestibulum ac enim id, porttitor laoreet magna. Vivamus dignissim dui id lectus cursus, ut dignissim turpis consequat. Vivamus feugiat, tellus at tincidunt faucibus, lorem sapien ullamcorper lacus, sed blandit urna turpis id elit. Praesent dignissim purus tempor nibh pulvinar tincidunt. Sed vitae volutpat felis, varius pharetra ipsum. Integer vehicula ipsum massa, porta venenatis lectus blandit sit amet.</p>

<p>Donec a nulla lobortis, porta risus a, pellentesque dolor. Aenean feugiat, felis in condimentum placerat, diam purus volutpat dui, quis sodales eros dolor id turpis. Suspendisse quam quam, lacinia molestie orci sit amet, mollis porta libero. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec vehicula volutpat dolor et placerat. Nulla vulputate, mauris et feugiat tempus, augue magna iaculis orci, ut convallis turpis mi sit amet odio. Duis id neque odio. Aliquam semper dolor nec enim vestibulum suscipit. Vestibulum placerat nulla pharetra porta volutpat. Donec porttitor nec diam eu mattis. Praesent sed urna et lectus blandit vehicula elementum quis massa. Maecenas vulputate velit sed pellentesque malesuada. Nullam pretium est et nunc pellentesque fermentum. Integer consectetur elit elementum congue ultrices. Curabitur ac neque leo.</p>

<p>Nulla facilisi. Sed ornare dolor sit amet justo interdum ullamcorper. Nulla facilisi. Ut pellentesque convallis nisi, ac euismod nisl congue vitae. Fusce luctus viverra tempus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum lobortis non sem ut porttitor. Aliquam vel hendrerit nisi, et venenatis odio. Vivamus id lacinia ligula, in varius velit. Fusce sed hendrerit velit. Cras commodo, sapien vel commodo dignissim, risus erat mollis felis, nec sagittis urna dui eget magna. Sed facilisis nulla tellus, auctor auctor urna porta nec. Donec varius, tellus vel suscipit sollicitudin, nulla orci egestas leo, at venenatis nisl tellus sit amet ligula. Donec in luctus mi, ac consectetur tortor.</p>
");
        $articulo->setTitulo('Titulo Articulo' . $i);

        foreach ($usuarios as $usuario) {
            $comentario = new \Articulos\Model\Entity\Comentario();
            $comentario->setAutor($usuario);
            $comentario->setEstado($estadoActivo);
            $comentario->setFechaHora(new \DateTime());
            $comentario->setPost($articulo);
            $comentario->setTexto("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean velit quam, pellentesque ac volutpat adipiscing, pharetra quis mauris. Donec ullamcorper enim non massa tempus varius. Nunc aliquam ornare lectus. Etiam porta lacinia orci dignissim cursus. Duis risus orci, viverra at iaculis a, consectetur in augue. Nullam a lobortis felis, a semper massa. In at condimentum nisi. Praesent sed risus nisl. Phasellus est nulla, egestas eget erat ut, molestie sagittis dolor. Cras nec ullamcorper odio, a porta tellus.");
            $articulo->addComentario($comentario);

            $comentario2 = new \Articulos\Model\Entity\Comentario();
            $comentario2->setAutor($usuario);
            $comentario2->setEstado($estadoActivo);
            $comentario2->setFechaHora(new \DateTime());
            $comentario2->setPost($articulo);
            $comentario2->setPadre($comentario);
            $comentario->addComentario($comentario2);
            $comentario2->setTexto("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean velit quam, pellentesque ac volutpat adipiscing, pharetra quis mauris. Donec ullamcorper enim non massa tempus varius. Nunc aliquam ornare lectus. Etiam porta lacinia orci dignissim cursus. Duis risus orci, viverra at iaculis a, consectetur in augue. Nullam a lobortis felis, a semper massa. In at condimentum nisi. Praesent sed risus nisl. Phasellus est nulla, egestas eget erat ut, molestie sagittis dolor. Cras nec ullamcorper odio, a porta tellus.");
            $articulo->addComentario($comentario2);
        }

        $em->persist($articulo);
    }

    $em->flush();

    $tiposDesarrollo = $em->getRepository('Proyectos\Model\Entity\TipoProyecto')->findAll();

    foreach ($tiposDesarrollo as $tipo) {
        for ($i = 0; $i < 20; $i++) {
            $proyecto = new Proyectos\Model\Entity\Proyecto();

            $proyecto->setAutor($autor);
            $proyecto->setCodename('P.R.O.Y.E.C.T.O ' . $i);
            $proyecto->setCupo(30);
            $proyecto->setDuracionMeses(12);
            $proyecto->setEstado($estadoActivo);
            $proyecto->setFechaHoraPublicacion(new \DateTime());
            $proyecto->setFechaInicio(new \DateTime());
            $proyecto->setImagen(ARTICLE_DEFAULT_IMAGE);
            $proyecto->setTexto("<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean velit quam, pellentesque ac volutpat adipiscing, pharetra quis mauris. Donec ullamcorper enim non massa tempus varius. Nunc aliquam ornare lectus. Etiam porta lacinia orci dignissim cursus. Duis risus orci, viverra at iaculis a, consectetur in augue. Nullam a lobortis felis, a semper massa. In at condimentum nisi. Praesent sed risus nisl. Phasellus est nulla, egestas eget erat ut, molestie sagittis dolor. Cras nec ullamcorper odio, a porta tellus.</p>

<p>Duis eget libero et sem pretium tempor nec in leo. Nullam in consequat massa, non vulputate tortor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst. Morbi interdum, felis sed vestibulum bibendum, dui tellus ultrices lacus, sit amet sodales neque ipsum in ligula. Vestibulum quam ipsum, interdum non urna eget, ullamcorper commodo nisi. Vestibulum aliquam, velit quis ullamcorper laoreet, mi nibh rhoncus eros, et ultrices velit tellus non orci. Sed pellentesque sed tellus nec fermentum. Duis consectetur orci nibh, id adipiscing dui blandit vitae. Donec lacinia euismod dui eget vestibulum.</p>

<p>Sed laoreet hendrerit elit. Etiam eros augue, placerat bibendum mauris ac, malesuada pretium nulla. Sed nulla dolor, vestibulum ac enim id, porttitor laoreet magna. Vivamus dignissim dui id lectus cursus, ut dignissim turpis consequat. Vivamus feugiat, tellus at tincidunt faucibus, lorem sapien ullamcorper lacus, sed blandit urna turpis id elit. Praesent dignissim purus tempor nibh pulvinar tincidunt. Sed vitae volutpat felis, varius pharetra ipsum. Integer vehicula ipsum massa, porta venenatis lectus blandit sit amet.</p>

<p>Donec a nulla lobortis, porta risus a, pellentesque dolor. Aenean feugiat, felis in condimentum placerat, diam purus volutpat dui, quis sodales eros dolor id turpis. Suspendisse quam quam, lacinia molestie orci sit amet, mollis porta libero. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec vehicula volutpat dolor et placerat. Nulla vulputate, mauris et feugiat tempus, augue magna iaculis orci, ut convallis turpis mi sit amet odio. Duis id neque odio. Aliquam semper dolor nec enim vestibulum suscipit. Vestibulum placerat nulla pharetra porta volutpat. Donec porttitor nec diam eu mattis. Praesent sed urna et lectus blandit vehicula elementum quis massa. Maecenas vulputate velit sed pellentesque malesuada. Nullam pretium est et nunc pellentesque fermentum. Integer consectetur elit elementum congue ultrices. Curabitur ac neque leo.</p>

<p>Nulla facilisi. Sed ornare dolor sit amet justo interdum ullamcorper. Nulla facilisi. Ut pellentesque convallis nisi, ac euismod nisl congue vitae. Fusce luctus viverra tempus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum lobortis non sem ut porttitor. Aliquam vel hendrerit nisi, et venenatis odio. Vivamus id lacinia ligula, in varius velit. Fusce sed hendrerit velit. Cras commodo, sapien vel commodo dignissim, risus erat mollis felis, nec sagittis urna dui eget magna. Sed facilisis nulla tellus, auctor auctor urna porta nec. Donec varius, tellus vel suscipit sollicitudin, nulla orci egestas leo, at venenatis nisl tellus sit amet ligula. Donec in luctus mi, ac consectetur tortor.</p>
");
            $proyecto->setTipo($tipo);
            $proyecto->setTitulo($tipo->getNombre() . ' ' . $i);
            $proyecto->setVersion('0.0.0' . $i);

            foreach ($usuarios as $usuario) {
                echo $usuario->getId();
                $inscripcionProyecto = new \Proyectos\Model\Entity\InscripcionProyecto();
                $inscripcionProyecto->setDescripcionActividad("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean velit quam, pellentesque ac volutpat adipiscing, pharetra quis mauris. Donec ullamcorper enim non massa tempus varius. Nunc aliquam ornare lectus. Etiam porta lacinia orci dignissim cursus. Duis risus orci, viverra at iaculis a, consectetur in augue. Nullam a lobortis felis, a semper massa. In at condimentum nisi. Praesent sed risus nisl. Phasellus est nulla, egestas eget erat ut, molestie sagittis dolor. Cras nec ullamcorper odio, a porta tellus.");
                $inscripcionProyecto->setFechaInscripcion(new \DateTime());
                $inscripcionProyecto->setEstado($estadoAceptado);
                $inscripcionProyecto->setPersona($usuario->getPersona());
                $inscripcionProyecto->setProyecto($proyecto);
                $inscripcionProyecto->setRol($rolParticipante);

                $proyecto->addInscripcionProyecto($inscripcionProyecto);
            }

            $em->persist($proyecto);
        }
    }


    $em->flush();
    $em->getConnection()->commit();
} catch (Exception $e) {
    $em->getConnection()->rollback();
    $em->close();
    echo $e->getMessage();
    //throw $e;
}
?>
