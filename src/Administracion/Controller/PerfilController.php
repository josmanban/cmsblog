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
        
    }

    public function newAction() {
        
    }

    public function showAction() {
        
    }

    public function miPerfilAction() {
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
                View::render(MI_PERFIL, array('usuario' => $usuario,'perfilCompleto'=>$perfilCompleto));
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
    if (is_null($perfil))
        $perfil = new \Administracion\Model\Entity\Perfil();
    if (is_null($perfil->getId())) {
        $idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : -1;
        $usuario = $this->em->getRepository('Administracion\Model\Entity\Usuario')->find($idUsuario);
        if (is_null($usuario))
            throw new NotFoundEntityException('Usuario');
        $perfil->setUsuario($usuario);
    }
    $perfil->setDescripcion($descripcion);
    $validator = new \Administracion\Model\Validator\PerfilValidator($perfil);
    $validator->validate();

    /*     * *** actualizo la imagen de haberla********* */
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
    elseif (is_null($perfil->getId())) {
        $perfil->setAvatar(USER_DEFAULT_AVATAR);
    }
    return $perfil;
} catch (Exception $ex) {
    throw $ex;
}
}

}

?>
