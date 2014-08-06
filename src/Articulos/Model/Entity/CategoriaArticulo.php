<?php

namespace Articulos\Model\Entity;


use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 **/

class CategoriaArticulo {

     /** 
      * @Id
      * @GeneratedValue(strategy="AUTO")
      * @Column(type="integer")*/
    private $id;
    /**
     * @Column(length=150)
     */
    private $nombre;

    /**
     * @Column(length=300,nullable=true)
     */
    private $descripcion;


    /**
     * @ManyToMany(targetEntity="Articulo",mappedBy="categorias")
     */
    private $articulos;

    /**
     * @ManyToOne(targetEntity="\Administracion\Model\Entity\Estado",inversedBy="categoriasArticulo")
     */
    private $estado;

    public function __construct() {
        $this->articulos=new ArrayCollection();   
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

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function addArticulo(Articulo $articulo){
        $this->articulos[]=$articulo;
    }

    public function __toString() {
        
    }

}

?>
