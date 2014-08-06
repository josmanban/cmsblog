<?php 
namespace Librerias;

require_once __DIR__."/../../bootstrap.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Conexion{

	public static function getEntityManager(){
		$paths = array(
				__DIR__."/../Administracion/Model/Entity",
				__DIR__."/../Personas/Model/Entity",
				__DIR__."/../Articulos/Model/Entity",
				__DIR__."/../Proyectos/Model/Entity",
			);
		$isDevMode = true;
		$dbParams = array(
    		'driver'   => DB_DRIVER,
    		'user'     => DB_USER,
    		'password' => DB_PASSWORD,
    		'dbname'   => DB_NAME,
		);
		$config = Setup::createAnnotationMetadataConfiguration($paths,$isDevMode);
		$entityManager = EntityManager::create($dbParams, $config);
		return $entityManager;
	}
}

?>