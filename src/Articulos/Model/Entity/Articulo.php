<?php

namespace Articulos\Model\Entity;

use Articulos\Model\Entity\Post;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Description of Articulo
 *
 * @author jose
 * @Entity
 */
class Articulo extends Post {

    //put your code here  

    /**
     * @ManyToMany(targetEntity="CategoriaArticulo",inversedBy="articulos")
     * @JoinTable(name="articulos_categoria")
     */ 
    private $categorias;

    public function __construct(){
    	$this->categorias= new ArrayCollection();
    }

    public function getCategorias() {
        return $this->categorias;
    }

    public function setCategorias($categorias) {
        $this->categorias = $categorias;
    }

    public function addCategoria(CategoriaArticulo $categoria){
    	$categoria->addArticulo($this);
    	$this->categorias[]=$categoria;
    }

}

?>
