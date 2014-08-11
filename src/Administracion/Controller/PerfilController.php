<?php

namespace Administracion\Controller;

use Librerias\Controller;
use Librerias\View;
use Librerias\NotAllowedException;
use Librerias\NotLoggedException;
use Librerias\InvalidEntityException;
use Librerias\InvalidFormDataException;
use Librerias\MissingParametersException;
use Librerias\NotFoundEntityException;
use Librerias\Paginator;
use Librerias\Validator;
use Librerias\Conexion;
use Administracion\Model\Entity\Estado;
use Administracion\Model\Entity\Rol;
use Administracion\Model\Entity\Usuario;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * Description of UsuarioController
 *
 * @author jose
 */

class PerfilController extends Controller {

    //entity manager
    private $em;

    function __construct() {
        $this->em = Conexion::getEntityManager();
    }

    //put your code here
    public function createAction() {
        
    }

    public function deleteAction() {
        
    }

    public function editAction() {
        try {
            
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function indexAction() {
        try {
            if (isset($_SESSION['usuario']))
                $usuario = $_SESSION['usuario'];
            else
                throw new NotLoggedException();
            if (!$usuario->esAdministrador())
                throw new NotAllowedException();
            if (isset($_GET['page']))
                $page = $_GET['page'];
            else
                $page = 1;

            $numItems = $this->em->getRepository('Administracion\Model\Entity\Perfil')->contar(null);
            $criteria = [];
            $paginator = new Paginator('perfil', 'index', $page, ITEMS_X_PAGE_INDEX, $numItems, $criteria);


            $perfiles = $this->em->getRepository('Administracion\Model\Entity\Perfil')->findBy(
                    $criteria, array('id' => 'ASC'), $paginator->getLimit(), $paginator->getOffset()
            );

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                // require_once dirname(__FILE__) . '/../Views/Persona/index.html.php';
                View::render(PERFIL_INDEX, array(
                    'perfiles' => $perfiles,
                    'paginator' => $paginator,
                ));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function newAction() {
        
    }

    public function showAction() {
        
    }

    public function miPerfil() {
        try {
            if (isset($_SESSION['usuario']))
                $usuarioLogueado = $_SESSION['usuario'];
            else
                throw new NotLoggedException();
            if (!isset($_GET['id']))
                throw new MissingParametersException('id');
            $usuario = $this->em->getRepository('Administracion\Model\Entity\Usuario')->find($_GET['id']);
            if (is_null($usuario))
                throw new NotFoundEntityException('Usuario');
            if ($usuarioLogueado->esAdministrador() || $usuario->getId() == $usuarioLogueado->getId())
                $perfilCompleto = true;
            else
                $perfilCompleto = false;
            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(MI_PERFIL, array('usuario' => $usuario));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function updateAction() {
        try {
            
        } catch (InvalidFormDataException $ex) {
            View::render(PERFIL_EDIT, array(
                'errores' => $ex->getErrores(),
                'perfil' => $this->em->getRepository('Administracion\Model\Entity\Perfil')->find($_POST['id'])
                    )
            );
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    //valida creacion y edicion
    public function bind($perfil = null) {
        try {
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

            /*             * *** actualizo la imagen de haberla********* */
            if (!empty($_FILES['avatar']['name'])) {
                $temp = explode(".", $_FILES['avatar']["name"]);
                $extension = end($temp);
                if ($id == '-1')
                    $nextId = $this->em->getRepository('Administracion\Model\Entity\Perfil')->finNextId();
                else
                    $nextId = $perfil->getId();
                FuncionesVarias::saveImage(PERFIL_IMAGE_SAVE_PATH . 'perfil' . $nextId . '.' . $extension, 'avatar');
                $perfil->setAvatar(PERFIL_IMAGE_URL . 'perfil' . $nextId . '.' . $extension);
            }
            return $perfil;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}

?>
