<?php

namespace Proyectos\Model\Entity;

use Doctrine\ORM\EntityRepository;

class ProyectoRepository extends EntityRepository {

    public function findActivos() {

        try {
            $estadoActivo = $this->_em->getRepository('Administracion\Model\Entity\Estado')
                    ->findOneBy(array('nombre' => 'ACTIVO'));
            if (!is_null($estadoActivo))
                return $this->_em->getRepository('Proyectos\Model\Entity\Proyecto')->findBy(array('estado' => $estadoActivo->getId()));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function contar($filters = null) {
        try {
            if (is_null($filters))
                return count($this->_em->getRepository('Proyectos\Model\Entity\Proyecto')->findAll());
            return count($this->_em->getRepository('Proyectos\Model\Entity\Proyecto')->findBy($filters));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }   
    

}
?>

