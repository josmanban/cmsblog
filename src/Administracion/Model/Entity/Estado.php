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
      * @Column(type="integer")*/
    private $id;
    /** @Column(length=150,unique=true)*/
    private $nombre;
    /** @Column(length=400,nullable=true)*/
    private $descripcion;

    /**
      *
      * @OneToMany(targetEntity="Usuario",mappedBy="estado")
      *
      **/
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
        $this->usuarios= new ArrayCollection();
        $this->personas= new ArrayCollection();
        $this->posts= new ArrayCollection();
        $this->categoriasArticulo=new ArrayCollection();
        $this->comentarios= new ArrayCollection();
        $this->inscripcionesProyecto=new ArrayCollection();
    }

    public function getInscripcionesProyecto(){
        return $this->inscripcionesProyecto;
    }
    public function setInscripcionesProyecto(ArrayCollection $inscripcionesProyecto){
        $this->inscripcionesProyecto=$inscripcionesProyecto;
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
