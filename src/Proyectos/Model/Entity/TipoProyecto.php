<?php
namespace Proyectos\Model\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of TipoProyecto
 *
 * @author jose
 * @Entity (repositoryClass="Proyectos\Model\Entity\TipoProyectoRepository")
 */
class TipoProyecto {    


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
     * @OneToMany(targetEntity="Proyecto",mappedBy="tipo")
     */
    private $proyectos;

    public function __construct() {
        $this->proyectos=new ArrayCollection();
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
