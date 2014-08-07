<?php

namespace Articulos\Model\Entity;

use Doctrine\ORM\EntityRepository;

class CategoriaArticuloRepository extends EntityRepository {

    public function getActivos() {

        try {
            $estadoActivo = $this->_em->getRepository('Administracion\Model\Entity\Estado')
                    ->findOneBy(array('nombre' => 'ACTIVO'));
            if (!is_null($estadoActivo))
                return $this->_em->findBy(array('estado' => $estadoActivo->getId()));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function contar($filters = null) {
        try {
            if (is_null($filters))
                return count($this->_em->findAll());
            return count($this->_em->findBy($filters));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
?>

