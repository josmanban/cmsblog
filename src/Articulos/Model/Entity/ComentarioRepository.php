<?php

namespace Articulos\Model\Entity;

use Doctrine\ORM\EntityRepository;

class ComentarioRepository extends EntityRepository {

    public function findActivos() {

        try {
            $estadoActivo = $this->_em->getRepository('Administracion\Model\Entity\Estado')
                    ->findOneBy(array('nombre' => 'ACTIVO'));
            if (!is_null($estadoActivo))
                return $this->_em->getRepository('Articulos\Model\Entity\Comentario')->findBy(array('estado' => $estadoActivo->getId()));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function contar($filters = null) {
        try {
            if (is_null($filters))
                return count($this->_em->getRepository('Articulos\Model\Entity\Comentario')->findAll());
            return count($this->_em->getRepository('Articulos\Model\Entity\Comentario')->findBy($filters));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
?>

