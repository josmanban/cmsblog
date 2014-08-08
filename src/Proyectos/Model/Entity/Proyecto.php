<?php

namespace Proyectos\Model\Entity;

use Articulos\Model\Entity\Comentario;
use Articulos\Model\Entity\Post;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity (repositoryClass="Proyectos\Model\Entity\ProyectoRepository")
 */

class Proyecto extends Post {

    /**
     * @ManyToOne(targetEntity="TipoProyecto",inversedBy="proyectos")
     */
    private $tipo;

    /**
     * @Column(type="datetime",nullable=true)
     */
    private $fechaInicio;

    /**
     * @Colum(type="integer",nullable=true)
     */    
    private $duracionMeses;

    /**
     * @Colum(type="integer",nullable=true)
     */
    private $cupo;

    /**
     * @Column(length=150)
     */
    private $version;

    /**
     * @Column(length=150)
     */
    private $codename;

    /**
     * @OneToMany(targetEntity="InscripcionProyecto",mappedBy="proyectos")
     */
    private $inscripcionesProyecto;

    public function __contruct(){
        parent::__contruct();
        $this->inscripcionesProyecto=new ArrayCollection();

    }

    public function getInscripcionesProyecto(){
        return $this->inscripcionesProyecto;
    }
    public function setInscripcionesProyecto(InscricionProyecto $inscripcionesProyecto){
        $this->InscricionProyecto=$inscripcionesProyecto;
    }
    public function addInscripcionProyecto(InscricionProyecto $inscripcionProyecto){
        $this->inscripcionProyecto= $inscripcionProyecto;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getDuracionMeses() {
        return $this->duracionMeses;
    }

    public function setDuracionMeses($duracionMeses) {
        $this->duracionMeses = $duracionMeses;
    }

        public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    public function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

   

    public function getCupo() {
        return $this->cupo;
    }

    public function setCupo($cupo) {
        $this->cupo = $cupo;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getVersion() {
        return $this->version;
    }

    public function setVersion($version) {
        $this->version = $version;
    }

    public function getCodename() {
        return $this->codename;
    }

    public function setCodename($codename) {
        $this->codename = $codename;
    }

    public function esDesarrollo() {
        return $this->esTipo('desarrollo');
    }

    public function esCurso() {
        return $this->esTipo('curso');
    }

    public function esCharla() {
        return $this->esTipo('charla');
    }

    public function esTipo($tipo) {
        if (strtoupper($this->tipo->getNombre()) == strtoupper($tipo)) {
            return true;
        }
        return false;
    }

}

?>
