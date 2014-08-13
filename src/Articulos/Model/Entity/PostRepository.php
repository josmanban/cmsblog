<?php

namespace Articulos\Model\Entity;

use Doctrine\ORM\EntityRepository;
use Librerias\Conexion;

class PostRepository extends EntityRepository {

    public function findActivos() {

        try {
            $estadoActivo = $this->_em->getRepository('Administracion\Model\Entity\Estado')
                    ->findOneBy(array('nombre' => 'ACTIVO'));
            if (!is_null($estadoActivo))
                return $this->_em->getRepository('Articulos\Model\Entity\Post')->findBy(array('estado' => $estadoActivo->getId()));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
    
    

    public function contar($filters = null) {
        try {
            if (is_null($filters))
                return count($this->_em->getRepository('Articulos\Model\Entity\Post')->findAll());
            return count($this->_em->getRepository('Articulos\Model\Entity\Post')->findBy($filters));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function findNextId() {
        try {
            $query = $this->_em->createQuery("SELECT MAX(p.id) FROM Articulos\Model\Entity\Post p");
            return $query->getSingleScalarResult() + 1;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
?>

