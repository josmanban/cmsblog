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

    public function findCommentariosOrderByDate($idPost, $idPadre = -1) {
        try {

            $post = $this->_em->getRepository('Articulos\Model\Entity\Post')->find($idPost);
            $padre = $this->_em->getRepository('Articulos\Model\Entity\Comentario')->find($idPadre);
            if ($padre) {
                $query = $this->_em->createQuery("SELECT c FROM Articulos\Model\Entity\Comentario c WHERE"
                        . " c.post=:post AND c.padre=:padre ORDER BY c.fechaHora DESC");
                $query->setParameter('padre', $padre);
            } else {
                $query = $this->_em->createQuery("SELECT c FROM Articulos\Model\Entity\Comentario c WHERE"
                        . " c.post=:post AND c.padre IS NULL ORDER BY c.fechaHora DESC");
            }
            $query->setParameter('post', $post);


            return $query->getResult();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
?>

