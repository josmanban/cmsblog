<?php

namespace Articulos\Model\Entity;

use Administracion\Model\Entity\Usuario;
use Articulos\Model\Entity\Comentario;
use Doctrine\Common\Collections\ArrayCollection;
use Librerias\FuncionesVarias;

/**
 * Description of Post
 *
 * @author jose
 * @Entity (repositoryClass="Articulos\Model\Entity\PostRepository")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="discr",type="string")
 * @DiscriminatorMap({"articulo"="Articulo","proyecto"="\Proyectos\Model\Entity\Proyecto"})
 */
class Post {

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer") */
    protected $id;

    /**
     * @Column(length=300)
     */
    protected $titulo;

    /**
     * @Column(type="text")
     */
    protected $texto;

    /**
     * @Column(length=1000)
     */
    protected $imagen;

    /**
     * @Column(type="datetime")
     */
    protected $fechaHoraPublicacion;

    /**
     * 
     * @ManyToOne(targetEntity="\Administracion\Model\Entity\Usuario",inversedBy="posts")
     */
    protected $autor;

    /**
     * @Column(type="integer",nullable=true)
     */
    protected $numVisitas;

    /**
     * @ManyToOne(targetEntity="\Administracion\Model\Entity\Estado",inversedBy="posts")
     */
    protected $estado;

    /**
     * @OneToMany(targetEntity="Comentario",mappedBy="post")
     */
    protected $comentarios;

    public function __construc() {
        $this->comentarios = new ArrayCollection();
    }

    public function getComentarios() {
        return $this->comentarios;
    }

    public function setComentarios($comentarios) {
        $this->comentarios = $comentarios;
    }

    public function addComentario(Comentario $comentario) {
        $this->comentarios[] = $comentario;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function getFechaHoraPublicacion() {
        return $this->fechaHoraPublicacion;
    }

    public function setFechaHoraPublicacion($fechaHoraPublicacion) {
        $this->fechaHoraPublicacion = $fechaHoraPublicacion;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getNumVisitas() {
        return $this->numVisitas;
    }

    public function setNumVisitas($numVisitas) {
        $this->numVisitas = $numVisitas;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getResumen($numChar = 350) {
        if ($this->texto != null) {
            if (strlen($this->texto) > $numChar)
                return FuncionesVarias::getHtml(substr($this->texto, 0, $numChar) . '...');
            else
                return FuncionesVarias::getHtml($this->texto);
        }
        return null;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function esAutor($usuario) {
        if (is_null($usuario))
            return false;
        if (is_null($this->autor))
            return false;
        if ($this->autor->getId() === $usuario->getId())
            return true;
        return false;
    }

    public function getHtml() {
        return FuncionesVarias::getHtml($this->texto);
    }

}

?>
