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
use Librerias\Conexion;
use Personas\Model\Entity\Persona;
use Personas\Model\Validator\PersonaValidator;


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

    private $em;

    function __construct() {
        $this->em = Conexion::getEntityManager();
    }

    public function createAction() {
        try {
            $loguedUser = $_SESSION['usuario'];
            if (is_null($loguedUser))
                throw new NotLoggedException($ex);
            $personaUsuario = $this->em->getRepository('Personas\Model\Entity\Persona'
                    )->findOneBy(array('usuario' => $loguedUser->getId()));
            if (!$loguedUser->esAdministrador() && !is_null($personaUsuario))
                throw new NotAllowedException();

            $persona = $this->validate();
            $this->em->persist($persona);
            $this->em->flush();

            if ($_REQUEST['ajax']) {
                
            }

            View::render(PERSONA_EDIT, array(
                'mensajesExito' => ["Datos actualizados con exito."],
                'tiposDocumento' => $this->em->getRepository('Personas\Model\Entity\TipoDocumento')->findAll(),
                'usuarios' => $this->em->getRepository('Administracion\Model\Entity\Usuario')->findActivos(),
                'sexos' => $this->em->getRepository('Personas\Model\Entity\Sexo')->findAll(),
                'persona' => $persona,
            ));
        } catch (InvalidFormDataException $ex) {
            View::render(PERSONA_EDIT, array(
                'tiposDocumento' => $this->em->getRepository('Personas\Model\Entity\TipoDocumento')->findAll(),
                'usuarios' => $this->em->getRepository('Administracion\Model\Entity\Usuario')->findActivos(),
                'sexos' => $this->em->getRepository('Personas\Model\Entity\Sexo')->findAll(),
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
            $persona = $this->em->getRepository(
                            'Personas\Model\Entity\Persona'
                    )->find($id);
            if (is_null($persona))
                throw new NotFoundEntityException('persona');
            if (!$loguedUser->esAdministrador() && !$persona->esMiUsuario($loguedUser))
                throw new NotAllowedException();

            if (isset($_REQUEST['ajax'])) {
                
            } else {

                View::render(PERSONA_EDIT, array(
                    'tiposDocumento' => $this->em->getRepository('Personas\Model\Entity\TipoDocumento')->findAll(),
                    'usuarios' => $this->em->getRepository('Administracion\Model\Entity\Usuario')->findActivos(),
                    'sexos' => $this->em->getRepository('Personas\Model\Entity\Sexo')->findAll(),
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

            $filters = [];
            $numItems = $this->em->getRepository('Personas\Model\Entity\Persona')->contar($filters);                    
            $paginator = new Paginator('usuario', 'index', $page, ITEMS_X_PAGE_INDEX, $numItems, $filters);     
            $personas = $this->em->getRepository('Personas\Model\Entity\Persona')->findBy(
                    $filters, array('id' => 'ASC'), $paginator->getLimit(), $paginator->getOffset()
            );            

            if (isset($_REQUEST['ajax'])) {
                
            } else {
                // require_once dirname(__FILE__) . '/../Views/Persona/index.html.php';
                View::render(PERSONA_INDEX, array(
                    'personas' => $personas,
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
            $personaUsuario = $this->em->getRepository(
                            'Personas\Model\Entity\Persona'
                    )->findOneBy(array('usuario' => $usuario->getId()));
            if (!$usuario->esAdministrador() && !is_null($personaUsuario))
                throw new NotAllowedException();

            if (isset($_GET['ajax']) || isset($_POST['ajayx'])) {
                
            } else {
                View::render(PERSONA_NEW, array(
                    'tiposDocumento' => $this->em->getRepository('Personas\Model\Entity\TipoDocumento')->findAll(),
                    'usuarios' => $this->em->getRepository('Administracion\Model\Entity\Usuario')->findActivos(),
                    'sexos' => $this->em->getRepository('Personas\Model\Entity\Sexo')->findAll(),
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
            $persona = $idPersona != -1 ?
                    $this->em->getRepository('Personas\Model\Entity\Persona')->find($idPersona) :
                    $this->em->getRepository('Personas\Model\Entity\Persona')->findOneBy(array('usuario' => $usuario->getId()));
            if (is_null($persona))
              throw new NotFoundEntityException('persona');
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
            $persona = $this->em->getRepository('Personas\Model\Entity\Persona')->find($id);
            if (is_null($persona))
                throw new \Librerias\NotFoundEntityException();
            if (!$loguedUser->esAdministrador() && $persona->esMiUsuario($loguedUser))
                throw new NotAllowedException();

            $this->validate($persona);
            $this->em->persist($persona);
            $this->em->flush();

            if (isset($_REQUEST['ajax'])) {
                
            }
            View::render(PERSONA_EDIT, array(
                'mensajesExito' => ["Datos actualizados con exito."],
                'tiposDocumento' => $this->em->getRepository('Personas\Model\Entity\TipoDocumento')->findAll(),
                'usuarios' => $this->em->getRepository('Administracion\Model\Entity\Usuario')->findActivos(),
                'sexos' => $this->em->getRepository('Personas\Model\Entity\Sexo')->findAll(),
                'persona' => $persona
            ));
        } catch (InvalidFormDataException $ex) {
            View::render(PERSONA_EDIT, array(
                'tiposDocumento' => $this->em->getRepository('Personas\Model\Entity\TipoDocumento')->findAll(),
                'usuarios' => $this->em->getRepository('Administracion\Model\Entity\Usuario')->findActivos(),
                'sexos' => $this->em->getRepository('Personas\Model\Entity\Sexo')->findAll(),
                'persona' => $this->em->getRepository('Personas\Model\Entity\Persona')->find($_POST['id']),
                'errores' => $ex->getErrores(),
            ));
        } catch (\Exception $ex) {
            View::render(ERROR, array(
                'errores' => array($ex->getMessage()),
            ));
        }
    }

    /*
     * enlaza un formulario con una entidad 
     * valida los datos de una entidad persona para altas/modificaciones
     */

    public function bind($entity = null) {
        try {
            /*             * ********** obtengo los datos del formulario********* */
            $id = $_POST['id'];
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
            $lugarNacimiento = isset($_POST['lugarNacimiento']) ? $_POST['lugarNacimiento'] : '';
            $fechaNacimiento = isset($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento'] : '';
            $numDocumento = isset($_POST['numDocumento']) ? $_POST['numDocumento'] : '';
            $idTipoDocumento = isset($_POST['tipoDocumento']) ? $_POST['tipoDocumento'] : '-1';
            $idSexo = isset($_POST['sexo']) ? $_POST['sexo'] : '-1';
            $idEstado = isset($_POST['estado']) ? $_POST['estado'] : '-1';

            $tipoDocumento = $this->em->getRepository('Personas\Model\Entity\TipoDocumento')->find($idTipoDocumento);
            $estado = ($idEstado == '-1') ?
            $this->em->getRepository('Administracion\Model\Entity\Estado')->finOneBy(array('nombre' => 'ACTIVO')):
            $this->em->getRepository('Administracion\Model\Entity\Estado')->find($idEstado);
            $idUsuario = $_POST['usuario'];
            $sexo = $this->em->getRepository('Personas\Model\Entity\Sexo')->find($idSexo);
            $usuario = $this->em->getRepository('Administracion\Model\Entity\Usuario')->find($idUsuario);                   
            
            if (is_null($usuario))
                throw new \Librerias\NotFoundEntityException();

            /*             * *********** creo la nueva entidad y le paso los datos************ */
            if ($entity)
                $persona = $entity;
            else
                $persona = new Persona();

            if ($id != '-1')
                $persona->setId($id);
            $persona->setNombre($nombre);
            $persona->setApellido($apellido);
            $persona->setLugarNacimiento($lugarNacimiento);
            $persona->setFechaNacimiento($fechaNacimiento);
            $persona->setNumDocumento($numDocumento);         
            $persona->setTipoDocumento($tipoDocumento);
            $persona->setUsuario($usuario);
            $persona->setEstado($estado);
            $persona->setSexo($sexo);

            /*             * ***** Creo validador para la entidad, y valido los datos******** */
            $validator = new PersonaValidator($persona);
            $validator->validate();

            return $persona;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

?>