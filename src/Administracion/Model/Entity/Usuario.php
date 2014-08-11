<?php

namespace Administracion\Model\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Articulos\Model\Entity\Post;
use Articulos\Model\Entity\Comentario;
use Administracion\Model\Entity\Rol;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author jose
 *
 * @Entity (repositoryClass="Administracion\Model\Entity\UsuarioRepository")
 *
 */
class Usuario {

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer") */
    protected $id;

    /** @Column(type="string",length=150,unique=true) */
    protected $nombre;

    /** @Column(type="string",length=150) */
    protected $password;

    /**
     *
     * @ManyToOne(targetEntity="Estado",inversedBy="usuarios")
     *
     *
     * */
    protected $estado;

    /**
     * @ManyToMany(targetEntity="Rol", inversedBy="usuarios")
     * @JoinTable(name="usuarios_roles")
     * */
    protected $roles;

    /** @Column(length=150,unique=true) */
    protected $email;

    /**
     *
     * @OneToOne(targetEntity="Perfil",mappedBy="usuario")
     *
     * */
    protected $perfil;

    /**
     * @OneToOne(targetEntity="\Personas\Model\Entity\Persona",mappedBy="usuario")
     *
     * */
    protected $persona;

    /**
     * @OneToMany(targetEntity="\Articulos\Model\Entity\Articulo",mappedBy="autor")
     */
    protected $posts;

    /**
     * @OneToMany(targetEntity="\Articulos\Model\Entity\Comentario",mappedBy="autor")
     */
    protected $comentarios;

    function __construct() {
        $this->roles = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->comentarios = new ArrayCollection();
    }

    public function getNombre() {
        return $this->nombre;
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

    public function getPosts() {
        return $this->posts;
    }

    public function setPost($posts) {
        $this->posts = $posts;
    }

    public function addPost(Post $post) {
        $this->posts[] = $post;
    }

    public function getPersona() {
        return $this->persona;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
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

    public function getRoles() {
        return $this->roles;
    }

    public function setRoles($roles) {
        $this->roles = $roles;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPerfil() {
        return $this->perfil;
    }

    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    public function addRol(Rol $rol) {
        $this->roles->addUsuario($this);
        $this->roles[] = $rol;
    }

    public function __toString() {
        return $this->nombre;
    }

    public function esAdministrador() {
        return $this->esRol('administrador');
    }

    public function esAdministradorArticulo() {
        return $this->esRol('administradorArticulo');
    }

    public function esAdministradorProyecto() {
        return $this->esRol('administradorProyecto');
    }

    public function esNormal() {
        return $this->esRol('normal');
    }

    public function estaActivo() {
        return strtolower($this->estado->getNombre()) == 'activo';
    }

    public function estaDesactivo() {
        return strtolower($this->estado->getNombre()) == 'desactivo';
    }

    public function esPublicador() {
        return $this->esRol('publicador');
    }

    public function esPublicadorProyecto() {
        return $this->esRol('publicadorProyecto');
    }

    protected function esRol($rol) {
        foreach ($this->getRoles() as $rolUsuario) {
            if (strtolower($rolUsuario->getNombre()) == strtolower($rol))
                return true;
        }
        return false;
    }
    

}

?>
