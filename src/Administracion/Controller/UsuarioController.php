<?php

namespace Administracion\Controller;

use Librerias\Controller;
use Librerias\View;
use Librerias\NotAllowedException;
use Librerias\NotLoggedException;
use Librerias\InvalidEntityException;
use Librerias\Paginator;
use Librerias\Conexion;
use Administracion\Model\Entity\Estado;
use Administracion\Model\Entity\Rol;
use Administracion\Model\Entity\Usuario;
use Administracion\Model\Validator\UsuarioValidator;
use Administracion\Model\Entity\Perfil;
use Librerias\InvalidFormDataException;
use Librerias\Validator;
use Librerias\FuncionesVarias;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * Description of UsuarioController
 *
 * @author jose
 */

class UsuarioController extends Controller {

    private $em;

    function __construct() {
        $this->em = Conexion::getEntityManager();
    }

    //put your code here
    public function createAction() {
        try {
            if (isset($_SESSION['usuario']) && !$_SESSION['usuario']->esAdministrador())
                throw new NotAllowedException();

            $usuario = $this->bind();
            $perfil = new Perfil();
            $perfil->setAvatar(USER_DEFAULT_AVATAR);
            $usuario->setPerfil($perfil);
            $perfil->setUsuario($usuario);
            $this->em->persist($usuario);
            $this->em->persist($perfil);
            $this->em->flush();

            if ($this->isAjax()) {
                
            } else {
                View::render(USUARIO_NEW, array(
                    'mensajesExito' => ["Usuario creado con exito. Ya puedes iniciar sesión."],
                    'usuario' => $usuario,
                    'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findAll(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
                ));
            }
        } catch (InvalidFormDataException $ex) {
            View::render(USUARIO_NEW, array(
                'errores' => $ex->getErrores(),
                'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findAll(),
                'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
            ));
        } catch (\Exception $ex) {
            View::render(ERROR, array('errores' => array($ex->getMessage())));
        }
    }

    public function deleteAction() {
        header('HTTP/1.0 404 Not Found');
        echo 'jose';
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
            $usuario = $this->em->getRepository('Administracion\Model\Entity\Usuario')->find($id);
            if (is_null($usuario))
                throw new \Librerias\NotFoundEntityException();

            if ($this->isAjax()) {
                
            } else {
                View::render(USUARIO_EDIT, array(
                    'usuario' => $usuario,
                    'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findAll(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
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
            $numItems = $this->em->getRepository('Administracion\Model\Entity\Usuario')->contar($filters);
            $paginator = new Paginator('usuario', 'index', $page, ITEMS_X_PAGE_INDEX, $numItems, $filters);
            $usuarios = $this->em->getRepository('Administracion\Model\Entity\Usuario')->findBy(
                    $filters, array('id' => 'ASC'), $paginator->getLimit(), $paginator->getOffset()
            );

            if ($this->isAjax()) {
                
            } else {
                View::render(USUARIO_INDEX, array(
                    'usuarios' => $usuarios,
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

            if ($this->isAjax()) {
                
            } else {
                View::render(USUARIO_NEW, array(
                    'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findAll(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
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

            $usuario = $this->em->getRepository('Administracion\Model\Entity\Usuario')->find($id);
            $this->bind($usuario);

            $this->em->persist($usuario);
            $this->em->flush();

            $_SESSION['usuario'] = $this->em->getRepository('Administracion\Model\Entity\Usuario')
                    ->find($_SESSION['usuario']->getId());
            if ($this->isAjax()) {
                
            } else {
                View::render(USUARIO_EDIT, array(
                    'mensajesExito' => ["Usuario editado con exito."],
                    'usuario' => $usuario,
                    'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findAll(),
                    'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
                ));
            }
        } catch (InvalidFormDataException $ex) {
            View::render(USUARIO_EDIT, array(
                'errores' => $ex->getErrores(),
                'usuario' => $this->em->getRepository('Administracion\Model\Entity\Usuario')->find($_POST['id']),
                'roles' => $this->em->getRepository('Administracion\Model\Entity\Rol')->findAll(),
                'estados' => $this->em->getRepository('Administracion\Model\Entity\Estado')->findAll(),
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
                    $password = md5($_POST['password']);

                    $usuario = $this->em->getRepository('Administracion\Model\Entity\Usuario')->findOneBy(array('nombre' => $nombre, 'password' => $password));
                    if ($usuario != null) {
                        $_SESSION['usuario'] = $usuario;
                        if ($this->isAjax()) {
                            
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
        /* if (isset($_SESSION['usuario'])) {
          unset($_SESSION['usuario']);

          }
          if ($this->isAjax()) {

          } else */
        session_destroy();
        header('Location: index.php');
    }

    /*
     * Metodo que enlaza un formulario con una entidad, y ademas valida
     * @return entity
     * 
     */

    public function bind($usuario = null) {
        try {
            if ($usuario == null)
                $usuario = new Usuario();

            $id = $_POST['id'];
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            if ($id == '-1' || isset($_POST['password'])) {
                $password = isset($_POST['password']) ? $_POST['password'] : '';
                $repetirPassword = isset($_POST['repetirPassword']) ? $_POST['repetirPassword'] : '';
            }

            $idEstado = isset($_POST['estado']) ? $_POST['estado'] : '-1';
            $idRoles = isset($_POST['roles']) ? $_POST['roles'] : [];
            $estado = ($idEstado == '-1') ?
                    $this->em->getRepository('Administracion\Model\Entity\Estado')->findOneBy(
                            array('nombre' => 'ACTIVO')) :
                    $this->em->getRepository('Administracion\Model\Entity\Estado')->find($idEstado);
            if (count($idRoles) > 0) {
                foreach ($idRoles as $idRol) {
                    $roles[] = $this->em->getRepository('Administracion\Model\Entity\Rol')
                            ->find($idRol);
                }
            } else {
                $rol = $this->em->getRepository('Administracion\Model\Entity\Rol')
                        ->findOneBy(array('nombre' => 'NORMAL'));
                $roles[] = $rol;
            }
            if (is_null($usuario->getId()) || !empty($email))
                $usuario->setEmail($email);
            if (is_null($usuario->getId()) || !empty($password))
                $usuario->setPassword(md5($password));
            $usuario->setNombre($nombre);
            $usuario->setRoles($roles);
            $usuario->setEstado($estado);

            $validator = new UsuarioValidator($usuario, $password, $repetirPassword);
            $validator->validate();

            //$usuario->setId($id);

            if (!is_null($usuario->getId())) {

                $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
                $perfil = $usuario->getPerfil();
                $perfil->setDescripcion($descripcion);

                $validator = new \Administracion\Model\Validator\PerfilValidator($perfil);
                $validator->validate();

                /*                 * *** actualizo la imagen de haberla********* */
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
                elseif (is_null($perfil->getId()) || is_null($perfil->getAvatar()) || empty($perfil->getAvatar())) {
                    $perfil->setAvatar(USER_DEFAULT_AVATAR);
                }
            }


            return $usuario;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}

?>
