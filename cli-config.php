<?php
// cli-config.php
//require_once "bootstrap.php";

use Librerias\Conexion;

//return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(Conexion::getEntityManager());