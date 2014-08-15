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

}

?>
