<?php

namespace Administracion\Model\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mensaje
 *
 * @author joseppp
 * @Entity (repositoryClass="Administracion\Model\Entity\MensajeRepository")
 */
class Mensaje {
    //put your code here

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer") */
    private $id;

    /** @Column(length=2000) */
    private $texto;

    /** @Column(length=300) */
    private $asunto;

    /**
     * @Column(type="datetime")
     */
    private $fechaHora;

    /**
     *
     * @ManyToOne(targetEntity="Usuario",inversedBy="mensajesEnviados")
     * 
     */
    private $emisor;

    /**
     *
     * @ManyToOne(targetEntity="Usuario",inversedBy="mensajesRecividos")
     * 
     */
    private $receptor;

    /**
     *
     * @ManyToOne(targetEntity="Estado")
     */
    private $estado;

    /**
     *
     * @OneToOne(targetEntity="Mensaje")
     * 
     */
    private $padre;

    public function getId() {
        return $this->id;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getAsunto() {
        return $this->asunto;
    }

    public function getFechaHora() {
        return $this->fechaHora;
    }

    public function getEmisor() {
        return $this->emisor;
    }

    public function getReceptor() {
        return $this->receptor;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getPadre() {
        return $this->padre;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function setAsunto($asunto) {
        $this->asunto = $asunto;
    }

    public function setFechaHora($fechaHora) {
        $this->fechaHora = $fechaHora;
    }

    public function setEmisor($emisor) {
        $this->emisor = $emisor;
    }

    public function setReceptor($receptor) {
        $this->receptor = $receptor;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setPadre($padre) {
        $this->padre = $padre;
    }

}
