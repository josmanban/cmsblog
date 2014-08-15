<?php

namespace Administracion\Controller;

use Librerias\Controller;
use Librerias\InvalidFormDataException;
use Librerias\NotAllowedException;
use Librerias\NotLoggedException;
use Librerias\NotFoundEntityException;
use Librerias\Conexion;
use Librerias\MissingParametersException;
use Librerias\Paginator;
use Librerias\View;
use Administracion\Model\Entity\Mensaje;
use Administracion\Model\Validator\MensajeValidator;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MensajeController
 *
 * @author jose
 */
class MensajeController extends Controller {

    protected $em;

    public function __construct() {
        $this->em = Conexion::getEntityManager();
    }

    public function bind($entity = null) {
        try {
            if (is_null($entity))
                $entity = new Mensaje();

            $nombreReceptor = isset($_POST['receptor']) ? $_POST['receptor'] : "";
            $idEmisor = isset($_POST['emisor']) ? $_POST['emisor'] : -1;

            $idEstado = isset($_POST['estado']) ? $_POST['estado'] : -1;

            $texto = isset($_POST['texto']) ? $_POST['texto'] : '';
            $asunto = isset($_POST['asunto']) ? $_POST['asunto'] : '';

            $idPadre = isset($_POST['padre']) ? $_POST['padre'] : -1;

            $emisor = $this->em->getRepository('Administracion\Model\Entity\Usuario')->find($idEmisor);
            $receptor = $this->em->getRepository('Administracion\Model\Entity\Usuario')->findOneBy(array(
                'nombre' => $nombreReceptor
            ));
            $estado = $idEstado != -1 ? $this->em->getRepository('Administracion\Model\Entity\Estado')->find($idEstado) :
                    $this->em->getRepository('Administracion\Model\Entity\Estado')->findOneBy(array('nombre' => 'ACTIVO'));
            $padre = $this->em->getRepository('Administracion\Model\Entity\Mensaje')->find($idPadre);

            if (is_null($entity->getId())) {
                $entity->setFechaHora(new \DateTime());
                $entity->setLeido(false);
            }
            $entity->setEmisor($emisor);
            $entity->setReceptor($receptor);
            $entity->setTexto($texto);
            $entity->setAsunto($asunto);
            $entity->setPadre($padre);
            $entity->setEstado($estado);

            $validator = new MensajeValidator($entity);
            $validator->validate();
            return $entity;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function createAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();

            $mensaje = $this->bind();
            $this->em->persist($mensaje);
            $this->em->flush();

            if ($this->isAjax()) {
                
            } else {
                View::render(MENSAJE_NEW, array(
                    'mensajesExito' => ["Mensaje enviado."],
                    'estado' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findOneBy(
                            array('nombre' => 'ACTIVO')
                )));
            }
        } catch (InvalidFormDataException $ex) {
            View::render(MENSAJE_NEW, array(
                'padre' => $this->em->getRepository('Administracion\Model\Entity\Mensaje')->find($_POST['padre']),
                'errores' => $ex->getErrores(),
                'estado' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findOneBy(
                        array('nombre' => 'ACTIVO')
            )));
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function editAction() {
        
    }

    public function indexAction() {
        
    }

    public function papeleraAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();

            if (isset($_GET['page']))
                $page = $_GET['page'];
            else
                $page = 1;

            $desactivo = $this->em->getRepository('Administracion\Model\Entity\Estado')->findOneBy(array(
                'nombre' => 'DESACTIVO'
            ));

            $filters = ['emisor' => $usuario->getId(),
                'estado' => $desactivo->getId()];

            $numItems = $this->em->getRepository('Administracion\Model\Entity\Mensaje')->contar($filters);
            $paginator = new Paginator('mensaje', 'index', $page, ITEMS_X_PAGE_INDEX, $numItems, $filters);
            $mensajes = $this->em->getRepository('Administracion\Model\Entity\Mensaje')->findBy(
                    $filters, array('fechaHora' => 'DESC'), $paginator->getLimit(), $paginator->getOffset()
            );

            if ($this->isAjax()) {
                
            } else {
                View::render(MENSAJE_MAIL, array(
                    'mensajes' => $mensajes,
                    'paginator' => $paginator,
                    'tab' => 'papelera'
                ));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function recibidosAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();

            if (isset($_GET['page']))
                $page = $_GET['page'];
            else
                $page = 1;

            $activo = $this->em->getRepository('Administracion\Model\Entity\Estado')->findOneBy(array(
                'nombre' => 'ACTIVO'
            ));

            $filters = ['receptor' => $usuario->getId(),
                'estado' => $activo->getId()];

            $numItems = $this->em->getRepository('Administracion\Model\Entity\Mensaje')->contar($filters);
            $paginator = new Paginator('mensaje', 'index', $page, ITEMS_X_PAGE_INDEX, $numItems, $filters);
            $mensajes = $this->em->getRepository('Administracion\Model\Entity\Mensaje')->findBy(
                    $filters, array('fechaHora' => 'DESC'), $paginator->getLimit(), $paginator->getOffset()
            );

            if ($this->isAjax()) {
                
            } else {
                View::render(MENSAJE_MAIL, array(
                    'mensajes' => $mensajes,
                    'paginator' => $paginator,
                    'tab' => 'recibidos'
                ));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function enviadosAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();

            if (isset($_GET['page']))
                $page = $_GET['page'];
            else
                $page = 1;

            $activo = $this->em->getRepository('Administracion\Model\Entity\Estado')->findOneBy(array(
                'nombre' => 'ACTIVO'
            ));

            $filters = ['emisor' => $usuario->getId(),
                'estado' => $activo->getId()];

            $numItems = $this->em->getRepository('Administracion\Model\Entity\Mensaje')->contar($filters);
            $paginator = new Paginator('mensaje', 'index', $page, ITEMS_X_PAGE_INDEX, $numItems, $filters);
            $mensajes = $this->em->getRepository('Administracion\Model\Entity\Mensaje')->findBy(
                    $filters, array('fechaHora' => 'DESC'), $paginator->getLimit(), $paginator->getOffset()
            );

            if ($this->isAjax()) {
                
            } else {
                View::render(MENSAJE_MAIL, array(
                    'mensajes' => $mensajes,
                    'paginator' => $paginator,
                    'tab' => 'enviados'
                ));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function newAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();

            $idPadre = isset($_GET['res']) ? $_GET['res'] : -1;
            $padre = $this->em->getRepository(
                            'Administracion\Model\Entity\Mensaje')->find($idPadre);



            if ($this->isAjax()) {
                
            } else {
                View::render(MENSAJE_NEW, array(
                    'padre' => $padre,
                    'estado' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findOneBy(
                            array('nombre' => 'ACTIVO')
                )));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function showAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();
            $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : -1;
            $mensaje = $this->em->getRepository('Administracion\Model\Entity\Mensaje')->find($id);
            if (is_null($mensaje))
                throw new NotFoundEntityException('mensaje');
            if (!$usuario->esAdministrador() &&
                    !$usuario->getId() == $mensaje->getReceptor()->getId() &&
                    !$usuario->getId() == $mensaje->getEmisor()->getId())
                throw new NotAllowedException();
            if (!$mensaje->getLeido() && $usuario->getId() == $mensaje->getReceptor()->getId()) {
                $mensaje->setLeido(true);
                $this->em->persist($mensaje);
                $this->em->flush();
            }
            if ($this->isAjax()) {
                
            } else {
                View::render(MENSAJE_SHOW, array('mensaje' => $mensaje));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function setLeidoAction() {
        
    }

    public function setPapelera() {
        
    }

    public function getNumeroMensajesNoLeidos() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();

            return $this->em->getRepository('Administracion\Model\Entity\Mensaje')->countMensajesNoLeidos(
                            $usuario);

            if ($this->isAjax()) {
                
            } else {
                View::render(MENSAJE_MAIL, array(
                    'mensajes' => $mensajes,
                    'paginator' => $paginator,
                    'tab' => 'enviados'
                ));
            }
        } catch (\Exception $ex) {
            //View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

}

?>
