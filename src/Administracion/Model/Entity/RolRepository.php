<?php
namespace Administracion\Model\Entity;

use Doctrine\ORM\EntityRepository;

class RolRepository extends EntityRepository{
    
    /*public function findActivos(){
        try {
            $estadoActivo = $this->_em->getRepository('Administracion\Model\Entity\Estado')
                    ->findOneBy(array('nombre' => 'ACTIVO'));
            if (!is_null($estadoActivo))
                return $this->_em->getRepository('Administracion\Model\Entity\Rol')->findBy(array('estado' => $estadoActivo->getId()));
        } catch (\Exception $ex) {
            throw $ex;
        }        
    } */   
}

?>
