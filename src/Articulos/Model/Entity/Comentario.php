<?php

namespace Articulos\Model\Entity;

use Doctrine\Common\Collections\ArrayCollection;
/**
 * Description of Comentario
 *
 * @author jose
 * @Entity (repositoryClass="Articulos\Model\Entity\ComentarioRepository")
 */
class Comentario {
    //put your code here

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer") */
    private $id;

    /**
     * @ManyToOne(targetEntity="Post",inversedBy="comentarios")
     */
    private $post;

    /**
     * @ManyToOne(targetEntity="Comentario",inversedBy="hijos")
     *
     */
    private $padre;

    /**
     * @OneToMany(targetEntity="Comentario",mappedBy="padre")
     * 
     */
    private $hijos;

    /**
     * @Column(length=900)
     */
    private $texto;

    /**
     * @ManyToOne(targetEntity="\Administracion\Model\Entity\Usuario",inversedBy="comentarios")
     */
    private $autor;

    /**
     * @Column(type="datetime")
     */
    private $fechaHora;

    /**
     * @ManyToOne(targetEntity="\Administracion\Model\Entity\Estado",inversedBy="comentarios")
     */
    private $estado;

    public function __construct() {
        $this->hijos = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPost() {
        return $this->post;
    }

    public function setPost($post) {
        $this->post = $post;
    }

    public function getPadre() {
        return $this->padre;
    }

    public function setPadre($padre) {
        $this->padre = $padre;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getFechaHora() {
        return $this->fechaHora;
    }

    public function setFechaHora($fechaHora) {
        $this->fechaHora = $fechaHora;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getHijos() {
        return $this->hijos;
    }

    public function setHijos($hijos) {
        $this->hijos = $hijos;
    }

    public function addComentario(Comentario $comentario) {
        $this->hijos[] = $comentario;
    }

    public function __toString() {
        
    }
 

}

?>
