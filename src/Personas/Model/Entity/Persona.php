<?php

namespace Personas\Model\Entity;
use Doctrine\Common\Collections\ArrayCollection;
/**
 *
 * @Entity (repositoryClass="Personas\Model\Entity\PersonaRepository")
 */

class Persona {

    /** 
      * @Id
      * @GeneratedValue(strategy="AUTO")
      * @Column(type="integer") */
    private $id;

    /** @Column(length=150) */
    private $nombre;

    /** @Column(length=150) */
    private $apellido;

    /** @Column(type="datetime",nullable=true) */
    private $fechaNacimiento;

    /** @Column(length=150,nullable=true) */
    private $lugarNacimiento;

    /**
      *
      * @ManyToOne(targetEntity="TipoDocumento",inversedBy="personas")
      **/
    private $tipoDocumento;

    /** @Column(type="integer",nullable=true) */
    private $numDocumento;
    
    /**
      * @ManyToOne(targetEntity="\Administracion\Model\Entity\Estado",inversedBy="personas")
      **/
    private $estado;

    /**
      *
      * @OneToOne(targetEntity="\Administracion\Model\Entity\Usuario",inversedBy="persona")
      **/
    private $usuario;
    
    /**
      *
      * @ManyToOne(targetEntity="Sexo",inversedBy="personas")
      **/
    private $sexo;

    /**
     * @OneToMany(targetEntity="\Proyectos\Model\Entity\InscripcionProyecto",mappedBy="persona")
     */
    private $inscripcionesProyecto;

    public function __construct() {
       $this->inscripcionesProyecto=new ArrayCollection();        
    }

    public function getInscripcionesProyecto(){
        return $inscripcionesProyecto;
    }
    public function setInscripcionesProyecto(InscricionProyecto $inscripcionesProyecto){
        $this->InscricionProyecto=$inscripcionesProyecto;
    }
    public function addInscripcionProyecto(InscricionProyecto $inscripcionProyecto){
        $this->inscripcionProyecto= $inscripcionProyecto;
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

    public function getApellido() {
        return $this->apellido;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function getLugarNacimiento() {
        return $this->lugarNacimiento;
    }

    public function setLugarNacimiento($lugarNacimineto) {
        $this->lugarNacimiento = $lugarNacimineto;
    }

    public function getTipoDocumento() {
        return $this->tipoDocumento;
    }

    public function setTipoDocumento($tipoDocumento) {
        $this->tipoDocumento = $tipoDocumento;
    }

    public function getNumDocumento() {
        return $this->numDocumento;
    }

    public function setNumDocumento($numDocumento) {
        $this->numDocumento = $numDocumento;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function getApellidoNombre() {
        return $this->apellido . ', ' . $this->getNombre();
    }

    public function getFechaNacimientoStr() {

        if (is_object($this->fechaNacimiento))
            return $this->fechaNacimiento->format('d-m-Y');
        else
            return $this->fechaNacimiento;
    }

    public function esMiUsuario($usuario) {
        if (is_null($usuario))
            return false;
        if ($this->usuario->getId() == $usuario->getId())
            return true;
        return false;
    }

    public function __toString() {
        
    }

}

?>
