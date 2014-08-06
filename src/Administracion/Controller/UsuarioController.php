<?php

namespace Administracion\Controller;

use Librerias\Controller;
use Librerias\View;
use Librerias\NotAllowedException;
use Librerias\NotLoggedException;
use Librerias\InvalidEntityException;
use Librerias\Paginator;
use Administracion\Model\Entity\Estado;
use Administracion\Model\Entity\Rol;
use Administracion\Model\Entity\Usuario;
use Administracion\Model\Bussines\AdministracionBusiness;
use Librerias\InvalidFormDataException;
use Librerias\Validator;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * Description of UsuarioController
 *
 * @author jose
 */

class UsuarioController extends Controller {

	private $administracionBusinnes;

	function __construct() {
		$this->administracionBusinnes= new AdministracionBusiness();
	}

	//put your code here
	public function createAction() {
		try {
			if (isset($_SESSION['usuario']) && !$_SESSION['usuario']->esAdministrador())
				throw new NotAllowedException();

			$usuario = $this->bind();
			$this->administracionBusinnes->persistUsuario($usuario);

			if (isset($_GET['ajax']) || isset($_POST['ajayx'])) {

			} else {
				View::render(USUARIO_NEW, array(
							'mensajesExito' => ["Usuario creado con exito. Ya puedes iniciar sesión."],
							'usuario' => $usuario,
							'roles' => $this->administracionBusinnes->getRolesActivos(),
							'estados' => $this->administracionBusinnes->getEstados(),
							));
			}
		} catch (\Librerias\InvalidaFormDataException $ex) {
			View::render(USUARIO_NEW, array(
						'errores' => $ex->getErrores(),
						'roles' => $this->administracionBusinnes->getRolesActivos(),
						'estados' => $this->administracionBusinnes->getEstados(),
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
				throw new \Librerias\MissingParametersException(['id']);
			$id = $_GET['id'];
			$loguedUser = $_SESSION['usuario'];
			if ($loguedUser->getId() != $id && !$loguedUser->esAdministrador())
				throw new NotAllowedException();
			$usuario = $this->administracionBusinnes->getUsuario($id);
			if (is_null($usuario))
				throw new \Librerias\NotFoundEntityException();

			if (isset($_REQUEST['ajayx'])) {

			} else {
				View::render(USUARIO_EDIT, array(
							'usuario' => $usuario,
							'roles' => $this->administracionBusinnes->getRolesActivos(),
							'estados' => $this->administracionBusinnes->getEstados(),
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



			$numItems = $this->usuarioAccesoDatos->contarTodos(null);
			$parameters = [];
			$paginator = new Paginator('usuario', 'index', $page, Constantes::ITEMS_X_PAGE_INDEX, $numItems, $parameters);
			$parameters[] = [ 'offset' => $paginator->getOffset()];
			$parameters[] = ['limit' => $paginator->getLimit()];

			if (isset($_REQUEST['ajax'])) {

			} else {
				View::render(USUARIO_INDEX, array(
							'usuarios' => $this->usuarioAccesoDatos->consultarTodos($parameters),
							'paginator' => $paginator,
							));
			}
		} catch (\Exception $ex) {
			View::render(ERROR, array('errores' => array($ex->getMessage())));
		}
	}

	public function newAction() {
		try {
			if (isset($_SESSION['usuario']) && !$_SESSION['usuario']->esAdministrador())
				throw new NotAllowedException();

			if (isset($_GET['ajax']) || isset($_POST['ajayx'])) {

			} else {
				View::render(USUARIO_NEW, array(
							'roles' => $this->administracionBusinnes->getRolesActivos(),
							'estados' => $this->administracionBusinnes->getEstados(),
							));
			}
		} catch (\Exception $ex) {
			View::render(ERROR, array('errores' => array($ex->getMessage())));
		}
	}

	public function showAction() {

	}

	public function updateAction() {
		try {
			if (!isset($_SESSION['usuario']))
				throw new NotLoggedException();
			$loguedUser = $_SESSION['usuario'];
			if (!isset($_POST['id']))
				throw new MissingParametersException(['id']);
			$id = $_POST['id'];
			if ($loguedUser->getId() != $id && !$loguedUser->esAdministrador())
				throw new NotAllowedException();


			$usuario = $this->administracionBusinnes->getUsuario($id);
			$this->bind($usuario);
			$this->administracionBusinnes->persistUsuario($usuario);

			$_SESSION['usuario'] = $this->administracionBusinnes->getUsuario($_SESSION['usuario']->getId());

			if (isset($_REQUEST['ajax'])) {

			} else {
				View::render(USUARIO_EDIT, array(
							'mensajesExito' => ["Usuario editado con exito."],
							'usuario' => $usuario,
							'roles' => $this->administracionBusinnes->getRolesActivos(),
							'estados' => $this->administracionBusinnes->getEstados(),
							));
			}
		} catch (InvalidFormDataException $ex) {
			View::render(USUARIO_EDIT, array(
						'errores' => $ex->getErrores(),
						'usuario' => $this->administracionBusinnes->getUsuario($_POST['id']),
						'roles' => $this->administracionBusinnes->getRolesActivos(),
						'estados' => $this->administracionBusinnes->getEstados(),
						));
		} catch (\Exception $ex) {
			View::render(ERROR, array('errores' => array($ex->getMessage())));
		}
	}

	public function loginAction() {
		try {
			if (isset($_SESSION['usuario'])) {
				header('Location: index.php');
			} else {
				if (isset($_POST['nombre']) && isset($_POST['password'])) {
					$nombre = $_POST['nombre'];
					$password = $_POST['password'];

					$usuario = $this->administracionBusinnes->getUsuarioByNombreAndByPassword($nombre, md5($password));
					if ($usuario != null) {
						$_SESSION['usuario'] = $usuario;
						if (isset($_REQUEST['ajax'])) {

						}
						else
							header('Location: index.php');
					}
					else
						throw new \Exception('Nombre de usuario o contraseña incorrecta');
				}
				else
					throw new \Exception('Nombre de usuario o contraseña incorrecta');
			}
		} catch (\Exception $ex) {
			View::render(USUARIO_LOGIN, array('errores' => [$ex->getMessage()]));
		}
	}

	public function logoutAction() {
		if (isset($_SESSION['usuario'])) {
			unset($_SESSION['usuario']);
		}
		if (isset($_REQUEST['ajax'])) {

		}
		else
			header('Location: index.php');
	}

	/*
	 * Metodo que enlaza un formulario con una entidad
	 * @return entity
         * 
	 */     
	public function bind($usuario=null){		
		try {
			if ($usuario == null)
				$usuario = new Usuario();

			$id = $_POST['id'];
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
			$email = isset($_POST['email']) ? $_POST['email'] : '';
			if ($id == -1 || isset($_POST['password'])) {
				$password = isset($_POST['password']) ? $_POST['password'] : '';
				$repetirPassword = isset($_POST['repetirPassword']) ? $_POST['repetirPassword'] : '';
			}
			$idEstado = isset($_POST['estado']) ? $_POST['estado'] : '-1';
			$idRoles = isset($_POST['roles']) ? $_POST['roles'] : [];
			$estado = ($idEstado == '-1') ? $this->administracionBusinnes->getEstadoByNombre('activo') : $this->administracionBusinnes->getEstado($idEstado);
			if (count($idRoles) > 0) {
				foreach ($idRoles as $idRol) {
					$roles[] = $this->administracionBusinnes->getRol($idRol);
				}
			} else {
				$rol = $this->administracionBusinnes->getRolByNombre('normal');
				$roles[] = $rol;
			}		
			
			//$usuario->setId($id);

			if($id ==-1 || isset($_POST['email']))
				$usuario->setEmail($email);
			$usuario->setNombre($nombre);
			$usuario->setRoles($roles);
			$usuario->setEstado($estado);

			if ($id == -1|| isset($_POST['password'])) {
				//hacer validacion de contraseña
				if(Validator::validatePasswords($password,$repetirPassword))
					throw new InvalidFormDataException(array('Las contraseñas no coinciden.'));
				if(Validator::validatePasswordFormat($password))
					throw new InvalidEntityException(array('Password invalido.'));
				$usuario->setPassword(md5($password));
			}          			

			return $usuario;

		} catch (Exception $ex) {
			throw $ex;
		}
	}
}

?>
