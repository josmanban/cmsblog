<?php

namespace Administracion\Model\Business;

use Librerias\Conexion;
use Administracion\Model\Entity\Usuario;
use Administracion\Model\Entity\Pefil;
use Administracion\Model\Entity\Rol;
use Administracion\Model\Entity\Estado;
use Doctrine\ORM\Tool\Pagination\Paginator;

class AdministracionBusiness{

	//entity manager
	private $em;

	public function __construct(){
		$this->em=Conexion::getEntityManager();
	}

	/*
	 * la entidad ya tiene que estar manejada por el
	 * entityManager, sino pasa a ser manejada y se crea una 
	 * nueva 
	 */
	public function persistUsuario(Usuario $usuario){
		try{
			$this->em->persist($usuario);
			$this->em->flush();
		}			catch(\Exception $ex){
			throw $ex;
		}		
	}

	public function deleteUsuario($id){
		try{
			$usuario= $this->em->getRepository('Administracion\Model\Entity\Usuario')
			->find($id);
			if(!is_null($usuario)){
				$this->em->remove($usuario);
				$this->em->flush();
			}
		}catch(\Exception $ex){
			throw $ex;
		}

	}

	public function getUsuario($id){
		try{
			$usuario= $this->em->find('Administracion\Model\Entity\Usuario',$id);
			return $usuario;
		}catch(\Exception $ex){
			throw $ex;
		}	
	}

	public function getUsuarioByNombre($nombre){
		try{
			$usuario= $this->em->getRepository('Adminstracion\Model\Entity\Usuario')->
			findOneBy(array('nombre'=>$nombre));
			return $usuario;
		}catch(\Exception $ex){
			throw $ex;
		}
	}

	public function getUsuarioByNombreAndPassword($nombre,$password){
		try{
			$usuario= $this->em->getRepository('Adminstracion\Model\Entity\Usuario')->
			findOneBy(array('nombre'=>$nombre,'password'=>$password));
			return $usuario;
		}catch(\Exception $ex){
			throw $ex;
		}
	}

	public function getUsuariosActivos(){
		try{
			$estadoActivo= $this->em->getRepository('Administracion\Model\Entity\Estado')
			->findOneBy(array('nombre'=>'ACTIVO'));
			$usuarios= $this->em->getRepository('Administracion\Model\Entity\Usuario')->
			findBy(array('estado'=>$estadoActivo->getId()));
			return $usuarios;
		}catch(\Exception $ex){
			throw $ex;
		}	}

		public function getUsuarios($args=null){
			try{
				if(is_null($arg))
					return $this->em->getRepository()->findAll();
				return $this->em->getRepository('Administracion\Model\Entity\Usuario')
				->findBy($args);
			}catch(\Exception $ex){
				throw $ex;
			}	
		}

		public function persistPerfil(Perfil $perfil){
			try{
				$this->em->persist($perfil);
				$this->em->flush();
			}catch(\Exception $ex){
				throw $ex;
			}		
		}

		public function deletePerfil($id){
			try{
				$perfil= $this->em->getRepository('Administracion\Model\Entity\Perfil')
				->find($id);
				if(!is_null($perfil)){
					$this->em->remove($perfil);
					$this->em->flush();
				}
			}catch(\Exception $ex){
				throw $ex;
			}

		}

		public function getPerfil($id){
			try{
				return $this->em->find('Administracion\Model\Entity\Perfil',$id);
			}catch(\Exception $ex){
				throw $ex;
			}
		}

		public function getPerfilByIdUsuario($id){
			try{
				return $this->em->getRepository('Administracion\Model\Entiy\Perfil')
				->findOneBy(array('usuario'=>$id));
			}catch(\Exception $ex){
				throw $ex;
			}
		}

		public function getPerfilByNombreUsuario($nombre){
			try{
				$usuario= $this->em->getUsuarioByNombre($nombre);
				return $this->em->getRepository('Administracion\Model\Entiy\Perfil')
				->findOneBy(array('usuario'=>$usuario->getId()));
			}catch(\Exception $ex){
				throw $ex;
			}}

			public function getPerfiles($args=null){
				try{			
					if(is_null($arg))
						return $this->em->getRepository()->findAll();
					return $this->em->getRepository('Administracion\Model\Entity\Perfil')
					->findBy($args);
				}catch(\Exception $ex){
					throw $ex;
				}
			}


			public function getRol($id){
				try {
					$rol= $this->em->find('Administracion\Model\Entity\Rol',$id);			
					return $rol;
				}catch(\Exception $ex){
					throw $ex;
				}
			}

			public function getRolByNombre($nombre){
				try {
					$rol= $this->em->getRepository('Administracion\Model\Entity\Rol')->
					findOneBy(array('nombre'=>$nombre));			
					return $rol;
				}catch(\Exception $ex){
					throw $ex;
				}
			}

			public function getRolByNombreAndAmbito($nombre,$ambito){
				try {
					$rol= $this->em->getRepository('Administracion\Model\Entity\Rol')->
					findOneBy(array('nombre'=>$nombre,'ambito'=>$ambito));			
					return $rol;
				}catch(\Exception $ex){
					throw $ex;
				}	
			}	

			public function getRolesActivos(){
		try{/*
			   $dql= "SELECT r FROM Administracion\Model\Entity\Rol r JOIN r.estado e WHERE 
			   UPPER(e.nombre) LIKE 'ACTIVO'";
			   $query= $this->em->createQuery($dql);
			   $roles= $query->getResult();
			   return $roles;*/
			   $estadoActivo= $this->em->getRepository('Administracion\Model\Entity\Estado')
			   ->findOneBy(array('nombre'=>'ACTIVO'));
			   $roles= $this->em->getRepository('Administracion\Model\Entity\Rol')->
			   findBy(array('estado'=>$estadoActivo->getId()));
			   return $roles;
			}catch(\Exception $ex){
				throw $ex;
			}
		}

	/*
	 * $args debe ser un array de 4 elementos:
	 *	1-array de criterios de filtrado
	 *	2-array de criterio de ordenacion
	 *	3-limit
	 *	4-offset
	 */
	public function getRoles($args=null){
		try{
			if(is_null($arg))
				return $this->em->getRepository('Administracion\Model\Entity\Rol')->findAll();
			return $this->em->getRepository('Administracion\Model\Entity\Rol')
			->findBy($args);
		}catch(\Exception $ex){
			throw $ex;
		}
	}

	public function getEstado($id){
		try{
			$estado= $this->em->find('Administracion\Model\Entity\Estado',$id);		
		}catch(\Exception $ex){
			throw $ex;
		}

	}

	public function getEstadoByNombre($nombre){
		try{
			$estado= $this->em->getRepository('Administracion\Model\Entity\Estado')
			->findOneBy(array('nombre'=>$nombre));
			return $estado;
		}catch(\Exception $ex){
			throw $ex;
		}

	}

	public function getEstados($args=null){
		try{
			if(is_null($arg))
				return $this->em->getRepository()->findAll();		
			return $this->em->getRepository('Administracion\Model\Entity\Estado')
			->findBy($args);
		}catch(\Exception $ex){
			throw $ex;
		}
	}





}


?>
