<?php

namespace Proyectos\Model\Entity;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InscripcionProyecto
 *
 * @author jose
 * @Entity (repositoryClass="Proyectos\Model\Entity\InscripcionProyectoRepository")
 */
class InscripcionProyecto {

    //put your code here

     /** 
      * @Id
      * @GeneratedValue(strategy="AUTO")
      * @Column(type="integer")*/
    private $id;    

    /**
     * @Column(length=350,nullable=true)
     */
    private $descripcionActividad;
    //private $usuario;
    
    /**
     * @Column(type="datetime")
     */
    private $fechaInscripcion;

    /**
     * @ManyToOne(targetEntity="\Personas\Model\Entity\Persona",inversedBy="inscripcionesProyecto")
     */    
    private $persona;
    
    /**
     * @ManyToOne(targetEntity="\Administracion\Model\Entity\Rol",inversedBy="inscripcionesProyecto")
     */
    private $rol;
    
    /**
     * @ManyToOne(targetEntity="\Administracion\Model\Entity\Estado",inversedBy="inscripcionesProyecto")
     */
    private $estado;
    
    /**
     * @ManyToOne(targetEntity="Proyecto",inversedBy="inscripcionesProyecto")
     */
    private $proyecto;

    public function getProyecto() {
        return $this->proyecto;
    }

    public function setProyecto($proyecto) {
        $this->proyecto = $proyecto;
    }

    public function getDescripcionActividad() {
        return $this->descripcionActividad;
    }

    public function setDescripcionActividad($descripcionActividad) {
        $this->descripcionActividad = $descripcionActividad;
    }

    public function getPersona() {
        return $this->persona;
    }

    public function setPersona($persona) {
        $this->persona = $persona;
    }

    
    public function getFechaInscripcion() {
        return $this->fechaInscripcion;
    }

    public function setFechaInscripcion($fechaInscripcion) {
        $this->fechaInscripcion = $fechaInscripcion;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
    
    

}

?>
