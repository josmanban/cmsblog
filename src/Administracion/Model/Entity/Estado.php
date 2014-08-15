<?php

namespace Administracion\Model\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Proyectos\Model\Entity\InscripcionProyecto;

/**
 * 
 * @Entity (repositoryClass="Administracion\Model\Entity\EstadoRepository")
 */
class Estado {

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer") */
    private $id;

    /** @Column(length=150,unique=true) */
    private $nombre;

    /** @Column(length=400,nullable=true) */
    private $descripcion;

    /**
     *
     * @OneToMany(targetEntity="Usuario",mappedBy="estado")
     *
     * */
    private $usuarios;

    /**
     * @OneToMany(targetEntity="\Personas\Model\Entity\Persona",mappedBy="estado")
     */
    private $personas;

    /**
     * @OneToMany(targetEntity="\Articulos\Model\Entity\Articulo",mappedBy="estado")
     */
    private $posts;

    /**
     *
     * @Column(length=150)
     */
    private $ambito;

    public function getUsuarios() {
        return $this->usuarios;
    }

    public function setUsuarios($usuarios) {
        $this->usuarios = $usuarios;
    }

    public function getPersonas() {
        return $this->personas;
    }

    public function setPersonas($personas) {
        $this->personas = $personas;
    }

    public function getPosts() {
        return $this->posts;
    }

    public function setPosts($posts) {
        $this->posts = $posts;
    }

    public function getAmbito() {
        return $this->ambito;
    }

    public function setAmbito($ambito) {
        $this->ambito = $ambito;
    }

    public function getCategoriasArticulo() {
        return $this->categoriasArticulo;
    }

    public function setCategoriasArticulo($categoriasArticulo) {
        $this->categoriasArticulo = $categoriasArticulo;
    }

    public function getComentarios() {
        return $this->comentarios;
    }

    public function setComentarios($comentarios) {
        $this->comentarios = $comentarios;
    }

    /**
     * @OneToMany(targetEntity="\Articulos\Model\Entity\CategoriaArticulo",mappedBy="estado")
     */
    private $categoriasArticulo;

    /**
     * @OneToMany(targetEntity="\Articulos\Model\Entity\Comentario",mappedBy="estado")
     */
    private $comentarios;

    /**
     * @OneToMany(targetEntity="\Proyectos\Model\Entity\InscripcionProyecto",mappedBy="estado")
     */
    private $inscripcionesProyecto;

    public function __construct() {
        $this->usuarios = new ArrayCollection();
        $this->personas = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->categoriasArticulo = new ArrayCollection();
        $this->comentarios = new ArrayCollection();
        $this->inscripcionesProyecto = new ArrayCollection();
    }

    public function getInscripcionesProyecto() {
        return $this->inscripcionesProyecto;
    }

    public function setInscripcionesProyecto(ArrayCollection $inscripcionesProyecto) {
        $this->inscripcionesProyecto = $inscripcionesProyecto;
    }

//    public function addInscripcionesProyecto(InscricionProyecto $inscripcionProyecto){
//        $this->inscripcionesProyecto[]= $inscripcionProyecto;
//        $inscripcionProyecto->setEstado($this);
//    }

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
