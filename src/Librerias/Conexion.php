<?php

namespace Librerias;

require_once __DIR__ . "/../../bootstrap.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Conexion {

    private static $entityManager;

    private function __construct() {
        
    }

    //implementar correctamente el singleton, mas adelante,
    //debido a que todo tiene que estar manejado por el mismo manejador de entidades
    //para boludeces en cascada
    public static function getEntityManager() {

        if (is_null(self::$entityManager)) {
            $paths = array(
                __DIR__ . "/../Administracion/Model/Entity",
                __DIR__ . "/../Personas/Model/Entity",
                __DIR__ . "/../Articulos/Model/Entity",
                __DIR__ . "/../Proyectos/Model/Entity",
            );
            $isDevMode = true;
            $dbParams = array(
                'driver' => DB_DRIVER,
                'user' => DB_USER,
                'password' => DB_PASSWORD,
                'dbname' => DB_NAME,
            );
            $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
            self::$entityManager = EntityManager::create($dbParams, $config);
        }

        return self::$entityManager;
    }

}

?>