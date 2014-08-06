<?php

namespace Personas\Model\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Sexo
 *
 * @author jose
 * @Entity
 */
class Sexo {

    //put your code here

    /**
      * @Id
      * @GeneratedValue(strategy="AUTO")
      * @Column(type="integer") */
    private $id;
    /** @Column(length=150,unique=true) */
    private $nombre;

    /**
      * @OneToMany(targetEntity="Persona",mappedBy="sexo")
      */
    private $personas;

    public function __construct(){
        $this->personas= new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getPersonas(){
        return $this->personas;
    }


}

?>
