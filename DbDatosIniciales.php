<?php

$em = \Librerias\Conexion::getEntityManager();
$em->getConnection()->beginTransaction(); // suspend auto-commit
try {
    $nombresSexo = array('MASCULINO', 'FEMENINO', 'GAY', 'MUY GAY');

    foreach ($nombresSexo as $nombre) {
        $sexo = new \Personas\Model\Entity\Sexo();
        $sexo->setNombre($nombre);

        $em->persist($sexo);
    }

    $nombresTipoDocumento = array(
        'DNI', 'CEDULA', 'PASAPORTE'
    );

    foreach ($nombresTipoDocumento as $nombre) {
        $tipoDocumento = new \Personas\Model\Entity\TipoDocumento();
        $tipoDocumento->setNombre($nombre);
        $tipoDocumento->setDescripcion($nombre);
        $em->persist($tipoDocumento);
    }

    $dataEstados = array(
        array('nombre' => 'ACTIVO', 'ambito' => 'ADMINISTRACION'),
        array('nombre' => 'DESACTIVO', 'ambito' => 'ADMINISTRACION'),
        array('nombre' => 'ACEPTADO', 'ambito' => 'INSCRIPCIONPROYECTO'),
        array('nombre' => 'CANCELADO', 'ambito' => 'INSCRIPCIONPROYECTO'),
        array('nombre' => 'RECHAZADO', 'ambito' => 'INSCRIPCIONPROYECTO'),
        array('nombre' => 'PENDIENTE', 'ambito' => 'INSCRIPCIONPROYECTO'),
    );

    foreach ($dataEstados as $dataEstado) {
        $estado = new Administracion\Model\Entity\Estado();
        $estado->setNombre($dataEstado['nombre']);
        $estado->setDescripcion($dataEstado['nombre']);
        $estado->setAmbito($dataEstado['ambito']);
        $em->persist($estado);
    }

    $dataRoles = array(
        array('nombre' => 'NORMAL', 'ambito' => 'ADMINISTRACION'),
        array('nombre' => 'ADMINISTRADOR', 'ambito' => 'ADMINISTRACION'),
        array('nombre' => 'PUBLICADOR', 'ambito' => 'ADMINISTRACION'),
        array('nombre' => 'ADMINISTRADORPROYECTO', 'ambito' => 'ADMINISTRACION'),
        array('nombre' => 'ADMINISTRADORARTICULO', 'ambito' => 'ADMINISTRACION'),
        array('nombre' => 'PUBLICADORPROYECTO', 'ambito' => 'ADMINISTRACION'),
        array('nombre' => 'MAQUETADOR', 'ambito' => 'PROYECTO'),
        array('nombre' => 'DESARROLLADOR', 'ambito' => 'PROYECTO'),
        array('nombre' => 'PARTICIPANTE', 'ambito' => 'PROYECTO'),
        array('nombre' => 'EXPONENTE', 'ambito' => 'PROYECTO'),
        array('nombre' => 'PROJECTMANAGER', 'ambito' => 'PROYECTO'),
        array('nombre' => 'PROFESOR', 'ambito' => 'PROYECTO'),
        array('nombre' => 'ASISTENTE', 'ambito' => 'PROYECTO'),
        array('nombre' => 'ALUMNO', 'ambito' => 'PROYECTO'),
    );

    foreach ($dataRoles as $dataRol) {
        $rol = new Administracion\Model\Entity\Rol();
        $rol->setNombre($dataRol['nombre']);
        $rol->setDescripcion($dataRol['nombre']);
        $rol->setAmbito($dataRol['ambito']);
        $em->persist($rol);
    }


    $nombresCategoriasArticulo = array(
        'PORTADA', 'BLOG', 'NOTICIA'
    );

    foreach ($nombresCategoriasArticulo as $nombre) {
        $categoria = new \Articulos\Model\Entity\CategoriaArticulo();
        $categoria->setNombre($nombre);
        $categoria->setDescripcion($nombre);
        $em->persist($categoria);
    }


    $nombresTipoProyecto = array(
        'CURSO', 'CHARLA', 'DESARROLLO'
    );

    foreach ($nombresTipoProyecto as $nombre) {
        $tipo = new \Proyectos\Model\Entity\TipoProyecto();
        $tipo->setNombre($nombre);
        $tipo->setDescripcion($nombre);
        $em->persist($tipo);
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
