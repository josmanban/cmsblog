<?php
// bootstrap.php
require_once "vendor/autoload.php";

/*use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array(
	__DIR__."/src/Administracion/Model/Entity",
	__DIR__."/src/Personas/Model/Entity",
	__DIR__."/src/Articulos/Model/Entity",
	__DIR__."/src/Proyectos/Model/Entity",
	);
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'perro292',
    'dbname'   => 'cmsblog',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

*/

define('SITE_NAME', 'Fundasoft');
define('SITE_SLOGAN', 'barrilete barrilete');
define('SITE_URL', 'http://localhost/sites/cmsblog');

define('DB_HOST', 'localhost');
define('DB_NAME', 'cmsblog');
define('DB_USER', 'root');
define('DB_PASSWORD', 'perro292');
define('DB_DRIVER','pdo_mysql');

define('ARTICULOS_LEVEL_COMMENTS', 3);
define('ITEMS_X_PAGE_INDEX',10 );
define('ITEMS_X_PAGE_VIEWS',10 );


/**** Paths donde se guardan imagenes ***/

define('POST_IMAGE_URL', SITE_URL . '/img/post/');
define('POST_IMAGE_SAVE_PATH', dirname(__FILE__) . '/img/post/');
define('PERFIL_IMAGE_URL', SITE_URL . '/img/perfil/');
define('PERFIL_IMAGE_SAVE_PATH', dirname(__FILE__) . '/img/perfil/');
define('USER_DEFAULT_AVATAR', SITE_URL . '/img/user-image-default.png');

/*****************************************************/

/* * ********** PATH DE VISTAS************************** */

define('USUARIO_NEW', dirname(__FILE__) . '/src/Administracion/Resources/views/Usuario/new.html.php');
define('USUARIO_NEW_FORM', dirname(__FILE__) . '/src/Administracion/Resources/views/Usuario/newForm.html.php');
define('USUARIO_EDIT', dirname(__FILE__) . '/src/Administracion/Resources/views/Usuario/edit.html.php');
define('USUARIO_EDIT_FORM', dirname(__FILE__) . '/src/Administracion/Resources/views/Usuario/editForm.html.php');
define('USUARIO_INDEX', dirname(__FILE__) . '/src/Administracion/Resources/views/Usuario/index.html.php');
define('USUARIO_SHOW', dirname(__FILE__) . '/src/Administracion/Resources/views/Usuario/show.html.php');
define('USUARIO_LOGIN', dirname(__FILE__) . '/src/Administracion/Resources/views/Usuario/login.html.php');


define('PERSONA_NEW', dirname(__FILE__) . '/src/Personas/Resources/views/Persona/new.html.php');
define('PERSONA_EDIT', dirname(__FILE__) . '/src/Personas/Resources/views/Persona/edit.html.php');
define('PERSONA_EDIT_FORM', dirname(__FILE__) . '/src/Personas/Resources/views/Persona/editForm.html.php');
define('PERSONA_INDEX', dirname(__FILE__) . '/src/Personas/Resources/views/Persona/index.html.php');
define('PERSONA_SHOW', dirname(__FILE__) . '/src/Personas/Resources/views/Persona/show.html.php');
define('PERSONA_PAGE', dirname(__FILE__) . '/src/Personas/Resources/views/Persona/page.html.php');


define('PERFIL_NEW', dirname(__FILE__) . '/src/Administracion/Resources/views/Perfil/new.html.php');
define('PERFIL_EDIT', dirname(__FILE__) . '/src/Administracion/Resources/views/Perfil/edit.html.php');
define('PERFIL_EDIT_FORM', dirname(__FILE__) . '/src/Administracion/Resources/views/Perfil/editForm.html.php');
define('PERFIL_INDEX', dirname(__FILE__) . '/src/Administracion/Resources/views/Perfil/index.html.php');
define('PERFIL_SHOW', dirname(__FILE__) . '/src/Administracion/Resources/views/Perfil/show.html.php');
define('PERFIL_PAGE', dirname(__FILE__) . '/src/Administracion/Resources/views/Perfil/page.html.php');





define('ARTICULO_NEW', dirname(__FILE__) . '/src/Articulos/Resources/views/Articulo/new.html.php');
define('ARTICULO_NEW_FORM', dirname(__FILE__) . '/src/Articulos/Resources/views/Articulo/newForm.html.php');
define('ARTICULO_EDIT', dirname(__FILE__) . '/src/Articulos/Resources/views/Articulo/edit.html.php');
define('ARTICULO_EDIT_FORM', dirname(__FILE__) . '/src/Articulos/Resources/views/Articulo/editForm.html.php');
define('ARTICULO_INDEX', dirname(__FILE__) . '/src/Articulos/Resources/views/Articulo/index.html.php');
define('ARTICULO_SHOW', dirname(__FILE__) . '/src/Articulos/Resources/views/Articulo/show.html.php');
define('ARTICULO_MINIMAL', dirname(__FILE__) . '/src/Articulos/Resources/views/Articulo/minimal.html.php');
define('ARTICULO_PAGE', dirname(__FILE__) . '/src/Articulos/Resources/views/Articulo/page.html.php');
define('ARTICULO_PORTADA', dirname(__FILE__) . '/src/Articulos/Resources/views/Articulo/portada.html.php');



define('COMENTARIO_NEW', dirname(__FILE__) . '/src/Articulos/Resources/views/Comentario/new.html.php');
define('COMENTARIO_NEW_FORM', dirname(__FILE__) . '/src/Articulos/Resources/views/Comentario/newForm.html.php');
define('COMENTARIO_NEW_REPLY', dirname(__FILE__) . '/src/Articulos/Resources/views/Comentario/newReply.html.php');
define('COMENTARIO_NEW_REPLY_FORM', dirname(__FILE__) . '/src/Articulos/Resources/views/Comentario/newReplyForm.html.php');
define('COMENTARIO_SHOW', dirname(__FILE__) . '/src/Articulos/Resources/views/Comentario/show.html.php');
define('COMENTARIO_SHOW_TREE', dirname(__FILE__) . '/src/Articulos/Resources/views/Comentario/showTree.html.php');

define('PROYECTO_NEW', dirname(__FILE__) . '/src/Proyectos/Resources/views/Proyecto/new.html.php');
define('PROYECTO_NEW_FORM', dirname(__FILE__) . '/src/Proyectos/Resources/views/Proyecto/newForm.html.php');
define('PROYECTO_EDIT', dirname(__FILE__) . '/src/Proyectos/Resources/views/Proyecto/edit.html.php');
define('PROYECTO_EDIT_FORM', dirname(__FILE__) . '/src/Proyectos/Resources/views/Proyecto/editForm.html.php');
define('PROYECTO_INDEX', dirname(__FILE__) . '/src/Proyectos/Resources/views/Proyecto/index.html.php');
define('PROYECTO_SHOW', dirname(__FILE__) . '/src/Proyectos/Resources/views/Proyecto/show.html.php');
define('PROYECTO_ARCHIVE', dirname(__FILE__) . '/src/Proyectos/Resources/views/Proyecto/archive.html.php');
define('PROYECTO_MINIMAL', dirname(__FILE__) . '/src/Proyectos/Resources/views/Proyecto/minimal.html.php');
define('PROYECTO_PAGE', dirname(__FILE__) . '/src/Proyectos/Resources/views/Proyecto/page.html.php');



define('INSCRIPCION_PROYECTO_NEW', dirname(__FILE__) . '/src/Proyectos/Resources/views/InscripcionProyecto/new.html.php');
define('INSCRIPCION_PROYECTO_NEW_FORM', dirname(__FILE__) . '/src/Proyectos/Resources/views/InscripcionProyecto/newForm.html.php');
define('INSCRIPCION_PROYECTO_EDIT', dirname(__FILE__) . '/src/Proyectos/Resources/views/InscripcionProyecto/edit.html.php');
define('INSCRIPCION_PROYECTO_EDIT_FORM', dirname(__FILE__) . '/src/Proyectos/Resources/views/InscripcionProyecto/editForm.html.php');
define('INSCRIPCION_PROYECTO_INDEX', dirname(__FILE__) . '/src/Proyectos/Resources/views/InscripcionProyecto/index.html.php');
define('INSCRIPCION_PROYECTO_SHOW', dirname(__FILE__) . '/src/Proyectos/Resources/views/InscripcionProyecto/show.html.php');
define('INSCRIPCION_PROYECTO_ARCHIVE', dirname(__FILE__) . '/src/Proyectos/Resources/views/InscripcionProyecto/archive.html.php');
define('INSCRIPCION_PROYECTO_MINIMAL', dirname(__FILE__) . '/src/Proyectos/Resources/views/InscripcionProyecto/minimal.html.php');
define('INSCRIPCION_PROYECTO_PAGE', dirname(__FILE__) . '/src/Proyectos/Resources/views/InscripcionProyecto/page.html.php');



define('PAGINA_PORTADA', dirname(__FILE__) . '/src/Paginas/Resources/views/portada.html.php');
define('PAGINA_ADMIN', dirname(__FILE__) . '/src/Paginas/Resources/views/admin.html.php');
define('PAGINA_CONTACTO', dirname(__FILE__) . '/src/Paginas/Resources/views/contacto.html.php');
define('PAGINA_GALERIA', dirname(__FILE__) . '/src/Paginas/Resources/views/galeria.html.php');
define('PAGINA_NOSOTROS', dirname(__FILE__) . '/src/Paginas/Resources/views/nosotros.html.php');



/* * ********PLANTILLA GLOBALES***************** */
define('HEADER', dirname(__FILE__) . '/src/Templates/header.html.php');
define('HEADER_ADMIN', dirname(__FILE__) . '/src/Templates/headerAdmin.html.php');
define('CONTENT', dirname(__FILE__) . '/src/Templates/content.html.php');
define('CONTENT_ONE_COLUMN', dirname(__FILE__) . '/src/Templates/contentOneColumn.html.php');
define('ASIDE', dirname(__FILE__) . '/src/Templates/aside.html.php');
define('FOOTER', dirname(__FILE__) . '/src/Templates/footer.html.php');
define('FOOTER_ONE_COLUMN', dirname(__FILE__) . '/src/Templates/footerOneColumn.html.php');
define('PAGINATOR', dirname(__FILE__) . '/src/Templates/paginator.html.php');
define('ALTERNATIVE_PAGINATOR', dirname(__FILE__) . '/src/Templates/alternativePaginator.html.php');


define('MENSAJES', dirname(__FILE__) . '/src/Templates/mensajesErrores.html.php');
define('ERROR', dirname(__FILE__) . '/src/Templates/error.html.php');

