<?php

namespace Personas\Model\Entity;
use Doctrine\Common\Collection\ArrayCollection;

/**
 * @Entity 
 */

class TipoDocumento {

    /**
      * @Id
      * @GeneratedValue(strategy="AUTO")
      * @Column(type="integer") */
    private $id;
    /** @Column(length=150,unique=true) */
    private $nombre;
    /** @Column(length=300,nullable=true) */
    private $descripcion;

    /**
      * @OneToMany(targetEntity="Persona",mappedBy="tipoDocumento")
      */
    private $personas;

    public function __construct() {
        $this->personas=new ArrayCollection();
    }


    public function getPersonas(){
        return $this->personas;
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

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function __toString() {
        
    }

}

?>
