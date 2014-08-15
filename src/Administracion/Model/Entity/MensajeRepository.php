<?php

namespace Administracion\Model\Entity;

use Doctrine\ORM\EntityRepository;

class MensajeRepository extends EntityRepository {

    public function contar($filters = null) {
        try {
            if (is_null($filters))
                return count($this->_em->getRepository('Administracion\Model\Entity\Mensaje')->findAll());
            return count($this->_em->getRepository('Administracion\Model\Entity\Mensaje')->findBy($filters));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function countMensajesNoLeidos($usuario) {
        try {
            $query = $this->_em->createQuery("SELECT COUNT(m.id) FROM Administracion\Model\Entity\Mensaje m 
                WHERE m.leido=:leido AND m.receptor=:receptor");
            $query->setParameter('leido', false);
            $query->setParameter('receptor', $usuario);
            return $query->getSingleScalarResult();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

?>
