<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

namespace Personas\Controller;

use Librerias\Paginator;
use Librerias\Constantes;
use Librerias\Controller;
use Librerias\NotAllowedException;
use Librerias\NotLoggedException;
use Librerias\NotFoundEntityException;
use Librerias\InvalidEntityException;
use Librerias\MissingParametersException;
use Librerias\InvalidFormDataException;
use Librerias\FuncionesVarias;
use Librerias\View;
use Personas\Model\Persona;
use Personas\Model\PersonaAccesoDatos;
use Personas\Model\TipoDocumentoAccesoDatos;
use Personas\Model\SexoAccesoDatos;
use Personas\Validator\PersonaValidator;
use Administracion\FacadeAdministracion;
use Administracion\Model\UsuarioAccesoDatos;
use Administracion\Model\EstadoAccesoDatos;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioController
 *
 * @author jose
 */
class PersonaController extends Controller {

    private $personaAccesoDatos;
    private $tipoDocumentoAccesoDatos;
    private $sexoAccesoDatos;
    private $savePathFoto;
    private $pathPhoto;

    function __construct() {

        $this->personaAccesoDatos = new PersonaAccesoDatos();
        $this->tipoDocumentoAccesoDatos = new TipoDocumentoAccesoDatos();
        $this->sexoAccesoDatos = new SexoAccesoDatos();
        $this->savePathPhoto = dirname(__DIR__) . '/../../img/Persona/foto/';
        $this->pathPhoto = SITE_URL . '/img/Persona/foto/';
    }

    public function createAction() {
        try {
            $loguedUser = $_SESSION['usuario'];
            if (is_null($loguedUser))
                throw new NotLoggedException($ex);
            $personaUsuario = $this->personaAccesoDatos->consultarPorIdUsuario($loguedUser->getId());
            if (!$loguedUser->esAdministrador() && !is_null($personaUsuario))
                throw new NotAllowedException();

            $persona = $this->validate();
            $this->personaAccesoDatos->insertar($persona);


            if ($_REQUEST['ajax']) {
                
            }

            View::render(PERSONA_EDIT, array(
                'mensajesExito' => ["Datos actualizados con exito."],
                'tiposDocumento' => $this->tipoDocumentoAccesoDatos->consultarActivos(),
                'usuarios' => FacadeAdministracion::getUsuariosActivos(),
                'sexos' => $this->sexoAccesoDatos->consultarActivos(),
                'persona' => $persona,
            ));
        } catch (InvalidFormDataException $ex) {
            View::render(PERSONA_EDIT, array(
                'tiposDocumento' => $this->tipoDocumentoAccesoDatos->consultarActivos(),
                'usuarios' => FacadeAdministracion::getUsuariosActivos(),
                'sexos' => $this->sexoAccesoDatos->consultarActivos(),
                'errores' => $ex->getErrores(),
            ));
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function deleteAction() {
        
    }

    public function editAction() {
        try {
            if (!isset($_SESSION['usuario']))
                throw new NotLoggedException();
            if (!isset($_GET['id']))
                throw new MissingParametersException(['id']);
            $loguedUser = $_SESSION['usuario'];
            $id = $_GET['id'];
            $persona = $this->personaAccesoDatos->consultarPorId($id);
            if (is_null($persona))
                throw new NotFoundEntityException('persona');
            if (!$loguedUser->esAdministrador() && !$persona->esMiUsuario($loguedUser))
                throw new NotAllowedException();

            if (isset($_REQUEST['ajax'])) {
                
            } else {

                View::render(PERSONA_EDIT, array(
                    'tiposDocumento' => $this->tipoDocumentoAccesoDatos->consultarActivos(),
                    'usuarios' => FacadeAdministracion::getUsuariosActivos(),
                    'sexos' => $this->sexoAccesoDatos->consultarActivos(),
                    'persona' => $persona
                ));
            }
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

            $numItems = $this->personaAccesoDatos->contarTodos(null);
            $parameters = [];
            $paginator = new Paginator('persona', 'index', $page, Constantes::ITEMS_X_PAGE_INDEX, $numItems, $parameters);
            $parameters[] = [ 'offset' => $paginator->getOffset()];
            $parameters[] = ['limit' => $paginator->getLimit()];

            //$personas = $this->personaAccesoDatos->consultarTodos($parameters);

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                // require_once dirname(__FILE__) . '/../Views/Persona/index.html.php';
                View::render(PERSONA_INDEX, array(
                    'personas' => $this->personaAccesoDatos->consultarTodos($parameters),
                    'paginator' => $paginator,
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
            $personaUsuario = $this->personaAccesoDatos->consultarPorId($usuario->getId());
            if (!$usuario->esAdministrador() && !is_null($personaUsuario))
                throw new NotAllowedException();

            if (isset($_GET['ajax']) || isset($_POST['ajayx'])) {
                
            } else {

                View::render(PERSONA_NEW, array(
                    'tiposDocumento' => $this->tipoDocumentoAccesoDatos->consultarActivos(),
                    'usuarios' => FacadeAdministracion::getUsuariosActivos(),
                    'sexos' => $this->sexoAccesoDatos->consultarActivos(),
                ));
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
            $idPersona = isset($_REQUEST['id']) ? $_REQUEST['id'] : -1;
            $persona = $idPersona != -1 ? $this->personaAccesoDatos->consultarPorId($idPersona) : $this->personaAccesoDatos->consultarPorIdUsuario($usuario->getId());
            /* if (is_null($persona))
              throw new NotFoundEntityException('persona'); */
            if (!$usuario->esAdministrador() && !$persona->esMiUsuario($usuario))
                throw new NotAllowedException();
            if (isset($_REQUEST['ajax'])) {
                
            } else {
                View::render(PERSONA_SHOW, array('persona' => $persona));
            }
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function updateAction() {
        try {
            if (isset($_SESSION['usuario']))
                $loguedUser = $_SESSION['usuario'];
            else
                throw new NotLoggedException();
            $id = $_POST['id'];
            $persona = $this->personaAccesoDatos->consultarPorId($id);
            if (is_null($persona))
                throw new \Librerias\NotFoundEntityException();
            if (!$loguedUser->esAdministrador() && $persona->esMiUsuario($loguedUser))
                throw new NotAllowedException();

            $this->validate($persona);
            $this->personaAccesoDatos->actualizar($persona);

            if (isset($_REQUEST['ajax'])) {
                
            }
            View::render(PERSONA_EDIT, array(
                'mensajesExito' => ["Datos actualizados con exito."],
                'tiposDocumento' => $this->tipoDocumentoAccesoDatos->consultarActivos(),
                'usuarios' => FacadeAdministracion::getUsuariosActivos(),
                'sexos' => $this->sexoAccesoDatos->consultarActivos(),
                'persona' => $persona
            ));
        } catch (InvalidFormDataException $ex) {
            View::render(PERSONA_EDIT, array(
                'tiposDocumento' => $this->tipoDocumentoAccesoDatos->consultarActivos(),
                'usuarios' => FacadeAdministracion::getUsuariosActivos(),
                'sexos' => $this->sexoAccesoDatos->consultarActivos(),
                'persona' => $this->personaAccesoDatos->consultarPorId($_POST['id']),
                'errores' => $ex->getErrores(),
            ));
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

    /*     * *** valida los datos de una entidad persona para altas/modificaciones****** */

    public function validate($entity = null) {

        /*         * ********** obtengo los datos del formulario********* */
        $id = $_POST['id'];
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
        $lugarNacimiento = isset($_POST['lugarNacimiento']) ? $_POST['lugarNacimiento'] : '';
        $fechaNacimiento = isset($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento'] : '';
        $numDocumento = isset($_POST['numDocumento']) ? $_POST['numDocumento'] : '';
        $idTipoDocumento = isset($_POST['tipoDocumento']) ? $_POST['tipoDocumento'] : '-1';
        $idSexo = isset($_POST['sexo']) ? $_POST['sexo'] : '-1';
        $idEstado = isset($_POST['estado']) ? $_POST['estado'] : '-1';

        $tipoDocumento = $this->tipoDocumentoAccesoDatos->consultarPorId($idTipoDocumento);
        $estado = ($idEstado == '-1') ? FacadeAdministracion::getEstadoPorNombre('activo') : FacadeAdministracion::getEstadoPorId($idEstado);
        $idUsuario = $_POST['usuario'];
        $sexo = $this->sexoAccesoDatos->consultarPorId($idSexo);

        $usuario = FacadeAdministracion::getUsuarioPorId($idUsuario);
        if (is_null($usuario))
            throw new \Librerias\NotFoundEntityException();

        /*         * *********** creo la nueva entidad y le paso los datos************ */
        if ($entity)
            $persona = $entity;
        else
            $persona = new Persona();

        $persona->setId($id);
        $persona->setNombre($nombre);
        $persona->setApellido($apellido);
        $persona->setLugarNacimiento($lugarNacimiento);
        $persona->setFechaNacimiento($fechaNacimiento);
        $persona->setNumDocumento($numDocumento);
        //$persona->setFoto($foto);
        $persona->setTipoDocumento($tipoDocumento);
        $persona->setUsuario($usuario);
        $persona->setEstado($estado);
        $persona->setSexo($sexo);

        /*         * ***** Creo validador para la entidad, y valido los datos******** */
        $validator = new PersonaValidator($persona);
        $validator->validate();

        return $persona;
    }

}

?>