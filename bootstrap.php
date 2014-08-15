<?php

// bootstrap.php
require_once "vendor/autoload.php";

define('SITE_NAME', 'Fundasoft');
define('SITE_SLOGAN', 'barrilete barrilete');
define('SITE_URL', 'http://localhost/sites/cmsblog');

define('DB_HOST', 'localhost');
define('DB_NAME', 'cmsblog');
define('DB_USER', 'root');
define('DB_PASSWORD', 'perro292');
define('DB_DRIVER', 'pdo_mysql');

define('ARTICULOS_LEVEL_COMMENTS', 3);
define('ITEMS_X_PAGE_INDEX', 10);
define('ITEMS_X_PAGE_VIEWS', 10);


/* * ** Paths donde se guardan imagenes ** */

define('POST_IMAGE_URL', SITE_URL . '/img/post/');
define('POST_IMAGE_SAVE_PATH', dirname(__FILE__) . '/img/post/');
define('PERFIL_IMAGE_URL', SITE_URL . '/img/perfil/');
define('PERFIL_IMAGE_SAVE_PATH', dirname(__FILE__) . '/img/perfil/');
define('USER_DEFAULT_AVATAR', SITE_URL . '/img/user-image-default.jpg');
define('ARTICLE_DEFAULT_IMAGE', SITE_URL . '/img/article-image-default.jpg');

/* * ************************************************** */

/* * ********** PATH DE VISTAS************************** */

define('USUARIO_NEW', dirname(__FILE__) . '/src/Administracion/Resources/views/Usuario/new.html.php');
define('USUARIO_NEW_FORM', dirname(__FILE__) . '/src/Administracion/Resources/views/Usuario/newForm.html.php');
define('USUARIO_EDIT', dirname(__FILE__) . '/src/Administracion/Resources/views/Usuario/edit.html.php');
define('USUARIO_EDIT_FORM', dirname(__FILE__) . '/src/Administracion/Resources/views/Usuario/editForm.html.php');
define('USUARIO_INDEX', dirname(__FILE__) . '/src/Administracion/Resources/views/Usuario/index.html.php');
define('USUARIO_SHOW', dirname(__FILE__) . '/src/Administracion/Resources/views/Usuario/show.html.php');
define('USUARIO_LOGIN', dirname(__FILE__) . '/src/Administracion/Resources/views/Usuario/login.html.php');

define('MENSAJE_NEW', dirname(__FILE__) . '/src/Administracion/Resources/views/Mensaje/new.html.php');
define('MENSAJE_FORM', dirname(__FILE__) . '/src/Administracion/Resources/views/Mensaje/form.html.php');
define('MENSAJE_MAIL', dirname(__FILE__) . '/src/Administracion/Resources/views/Mensaje/mail.html.php');
define('MENSAJE_SHOW', dirname(__FILE__) . '/src/Administracion/Resources/views/Mensaje/show.html.php');




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
define('PERFIL_FORM', dirname(__FILE__) . '/src/Administracion/Resources/views/Perfil/form.html.php');
define('MI_PERFIL', dirname(__FILE__) . '/src/Administracion/Resources/views/Perfil/miPerfil.html.php');





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
define('COMENTARIO_TREE', dirname(__FILE__) . '/src/Articulos/Resources/views/Comentario/tree.html.php');
define('COMENTARIO_AJAX', dirname(__FILE__) . '/src/Articulos/Resources/views/Comentario/ajax.html.php');

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
define('INSCRIPCION_PROYECTO_EDIT', dirname(__FILE__) . '/src/Proyectos/Resources/views/InscripcionProyecto/edit.html.php');
define('INSCRIPCION_PROYECTO_FORM', dirname(__FILE__) . '/src/Proyectos/Resources/views/InscripcionProyecto/form.html.php');
define('INSCRIPCION_PROYECTO_INDEX', dirname(__FILE__) . '/src/Proyectos/Resources/views/InscripcionProyecto/index.html.php');
define('INSCRIPCION_PROYECTO_MIS_INSCRIPCIONES', dirname(__FILE__) . '/src/Proyectos/Resources/views/InscripcionProyecto/misInscripciones.html.php');
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

