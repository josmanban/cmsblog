<?php
namespace Administracion\Model\Entity;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Perfil
 *
 * @author jose
 * @Entity (repositoryClass="Administracion\Model\Entity\PerfilRepository")
 */
class Perfil {

    //put your code here
    /**
      * @Id
      * @GeneratedValue(strategy="AUTO")
      * @Column(type="integer") */
    protected $id;

    /**
      * @OneToOne(targetEntity="Usuario",inversedBy="perfil")
      * 
      **/
    protected $usuario;

    /** @Column(length=1000,nullable=true) */
    protected $avatar;
    /** @Column(length=500,nullable=true) */
    protected $descripcion;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function setAvatar($avatar) {
        $this->avatar = $avatar;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

}

?>
