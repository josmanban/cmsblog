<?php

namespace Administracion\Model\Entity;

use \Doctrine\Common\Collections\ArrayCollection;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Roles
 *
 * @author jose
 * @Entity (repositoryClass="Administracion\Model\Entity\RolRepository")
 */
class Rol {
    //put your code here

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer") */
    private $id;

    /** @Column(length=150,unique=true) */
    private $nombre;

    /** @Column(length=400,nullable=true) */
    private $descripcion;

    /** @Column(length=150) */
    private $ambito;

    /**
     *
     * @ManyToMany(targetEntity="Usuario",mappedBy="roles")
     *
     * */
    private $usuarios;

    /**
     * @OneToMany(targetEntity="\Proyectos\Model\Entity\InscripcionProyecto",mappedBy="persona")
     */
    private $inscripcionesProyecto;

    public function __construct() {
        $this->usuarios = new ArrayCollection();
        $this->inscripcionesProyecto = new ArrayCollection();
    }

    public function getInscripcionesProyecto() {
        return $inscripcionesProyecto;
    }

   
    public function setInscripcionesProyecto($inscripcionesProyecto) {
        $this->InscricionProyecto = $inscripcionesProyecto;
    }

    public function addInscripcionProyecto(\Proyectos\Model\Entity\InscripcionProyecto $inscripcionProyecto) {
        $this->inscripcionProyecto = $inscripcionProyecto;
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

    public function getAmbito() {
        return $this->ambito;
    }

    public function setAmbito($ambito) {
        $this->ambito = $ambito;
    }

    public function getUsuarios() {
        return $this->usuarios;
    }

    public function setUsuarios($usuarios) {
        $this->usuarios = $usuarios;
    }

    public function addUsuario(Usuario $usuario) {
        $this->usuarios[] = $usuario;
    }

    public function __toString() {
        
    }

}

?>
