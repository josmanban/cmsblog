<?php

namespace Administracion\Controller;

use Librerias\Controller;
use Librerias\View;
use Librerias\NotAllowedException;
use Librerias\NotLoggedException;
use Librerias\InvalidEntityException;
use Librerias\Paginator;
use Librerias\Validator;
use Administracion\Model\Entity\Estado;
use Administracion\Model\Entity\Rol;
use Administracion\Model\Entity\Usuario;
use Librerias\InvalidFormDataException;
use Administracion\Model\Business\AdministracionBusiness;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * Description of UsuarioController
 *
 * @author jose
 */

class PerfilController extends Controller {

    private $administracionBusiness;

    function __construct() {
        $this->administracionBusiness= new AdministracionBusiness();
    }

    //put your code here
    public function createAction() {
        try {
            $loguedUser = $_SESSION['usuario'];
            if (is_null($loguedUser))
                throw new NotLoggedException($ex);
            $perfil = $loguedUser->getPerfil();
            if (!$loguedUser->esAdministrador() && !is_null($perfil))
                throw new NotAllowedException();
            $perfil = $this->validate();
            $this->administracionBusiness->insertar($perfil);
        } catch (\Librerias\InvalidaFormDataException $ex) {
            View::render(PERFIL_NEW, array(
                'errores' => $ex->getErrores(),
                'usuarios' => $this->administracionBusiness->consultarActivos(),
            ));
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
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

            $numItems = $this->administracionBusiness->contarTodos(null);
            $parameters = [];
            $paginator = new Paginator('persona', 'index', $page, Constantes::ITEMS_X_PAGE_INDEX, $numItems, $parameters);
            $parameters[] = [ 'offset' => $paginator->getOffset()];
            $parameters[] = ['limit' => $paginator->getLimit()];

            //$personas = $this->personaAccesoDatos->consultarTodos($parameters);

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                // require_once dirname(__FILE__) . '/../Views/Persona/index.html.php';
                View::render(PERFIL_INDEX, array(
                    'perfiles' => $this->administracionBusiness->consultarTodos($parameters),
                    'paginator' => $paginator,
                ));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function newAction() {
        try {
            
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function showAction() {
        
    }

    public function updateAction() {
        try {
            
        } catch (InvalidFormDataException $ex) {
            View::render(USUARIO_EDIT, array(
                'errores' => $ex->getErrores(),
                'usuario' => $this->administracionBusiness->consultarPorId($_POST['id']),
                'roles' => $this->rolAccesoDatos->consultarTodos(),
                'estados' => $this->estadoAccesoDatos->consultarActivos(),
            ));
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    //valida creacion y edicion
    public function bind($perfil = null) {
        try {

            return $perfil;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}

?>
