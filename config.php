<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
define('SITE_NAME', 'Fundasoft');
define('SITE_SLOGAN', 'barrilete barrilete');
define('SITE_URL', 'http://localhost/sites/cmsblog');

define('USER_DEFAULT_AVATAR', 'https://lh6.googleusercontent.com/-01gzVqTArx4/AAAAAAAAAAI/AAAAAAAAAAA/DE4mx1iBmYg/s32-c/photo.jpg');


define('DB_HOST', '');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASSWORD', '');

define('ARTICULOS_LEVEL_COMMENTS', 3);


/* * ********** PATH DE VISTAS************************** */

define('USUARIO_NEW', dirname(__FILE__) . '/src/Administracion/Views/Usuario/new.html.php');
define('USUARIO_NEW_FORM', dirname(__FILE__) . '/src/Administracion/Views/Usuario/newForm.html.php');
define('USUARIO_EDIT', dirname(__FILE__) . '/src/Administracion/Views/Usuario/edit.html.php');
define('USUARIO_EDIT_FORM', dirname(__FILE__) . '/src/Administracion/Views/Usuario/editForm.html.php');
define('USUARIO_INDEX', dirname(__FILE__) . '/src/Administracion/Views/Usuario/index.html.php');
define('USUARIO_SHOW', dirname(__FILE__) . '/src/Administracion/Views/Usuario/show.html.php');
define('USUARIO_LOGIN', dirname(__FILE__) . '/src/Administracion/Views/Usuario/login.html.php');


define('PERSONA_NEW', dirname(__FILE__) . '/src/Personas/Resources/views/Persona/new.html.php');
define('PERSONA_EDIT', dirname(__FILE__) . '/src/Personas/Resources/views/Persona/edit.html.php');
define('PERSONA_EDIT_FORM', dirname(__FILE__) . '/src/Personas/Resources/views/Persona/editForm.html.php');
define('PERSONA_INDEX', dirname(__FILE__) . '/src/Personas/Resources/views/Persona/index.html.php');
define('PERSONA_SHOW', dirname(__FILE__) . '/src/Personas/Resources/views/Persona/show.html.php');
define('PERSONA_PAGE', dirname(__FILE__) . '/src/Personas/Resources/views/Persona/page.html.php');


define('PERFIL_NEW', dirname(__FILE__) . '/src/Administracion/Views/Perfil/new.html.php');
define('PERFIL_EDIT', dirname(__FILE__) . '/src/Administracion/Views/Perfil/edit.html.php');
define('PERFIL_EDIT_FORM', dirname(__FILE__) . '/src/Administracion/Views/Perfil/editForm.html.php');
define('PERFIL_INDEX', dirname(__FILE__) . '/src/Administracion/Views/Perfil/index.html.php');
define('PERFIL_SHOW', dirname(__FILE__) . '/src/Administracion/Views/Perfil/show.html.php');
define('PERFIL_PAGE', dirname(__FILE__) . '/src/Administracion/Views/Perfil/page.html.php');




define('POST_IMAGE_URL', SITE_URL . '/img/post/');
define('POST_IMAGE_SAVE_PATH', dirname(__FILE__) . '/img/post/');

define('ARTICULO_NEW', dirname(__FILE__) . '/src/Articulos/Views/Articulo/new.html.php');
define('ARTICULO_NEW_FORM', dirname(__FILE__) . '/src/Articulos/Views/Articulo/newForm.html.php');
define('ARTICULO_EDIT', dirname(__FILE__) . '/src/Articulos/Views/Articulo/edit.html.php');
define('ARTICULO_EDIT_FORM', dirname(__FILE__) . '/src/Articulos/Views/Articulo/editForm.html.php');
define('ARTICULO_INDEX', dirname(__FILE__) . '/src/Articulos/Views/Articulo/index.html.php');
define('ARTICULO_SHOW', dirname(__FILE__) . '/src/Articulos/Views/Articulo/show.html.php');
define('ARTICULO_MINIMAL', dirname(__FILE__) . '/src/Articulos/Views/Articulo/minimal.html.php');
define('ARTICULO_PAGE', dirname(__FILE__) . '/src/Articulos/Views/Articulo/page.html.php');
define('ARTICULO_PORTADA', dirname(__FILE__) . '/src/Articulos/Views/Articulo/portada.html.php');



define('COMENTARIO_NEW', dirname(__FILE__) . '/src/Articulos/Views/Comentario/new.html.php');
define('COMENTARIO_NEW_FORM', dirname(__FILE__) . '/src/Articulos/Views/Comentario/newForm.html.php');
define('COMENTARIO_NEW_REPLY', dirname(__FILE__) . '/src/Articulos/Views/Comentario/newReply.html.php');
define('COMENTARIO_NEW_REPLY_FORM', dirname(__FILE__) . '/src/Articulos/Views/Comentario/newReplyForm.html.php');
define('COMENTARIO_SHOW', dirname(__FILE__) . '/src/Articulos/Views/Comentario/show.html.php');
define('COMENTARIO_SHOW_TREE', dirname(__FILE__) . '/src/Articulos/Views/Comentario/showTree.html.php');

define('PROYECTO_NEW', dirname(__FILE__) . '/src/Proyectos/Views/Proyecto/new.html.php');
define('PROYECTO_NEW_FORM', dirname(__FILE__) . '/src/Proyectos/Views/Proyecto/newForm.html.php');
define('PROYECTO_EDIT', dirname(__FILE__) . '/src/Proyectos/Views/Proyecto/edit.html.php');
define('PROYECTO_EDIT_FORM', dirname(__FILE__) . '/src/Proyectos/Views/Proyecto/editForm.html.php');
define('PROYECTO_INDEX', dirname(__FILE__) . '/src/Proyectos/Views/Proyecto/index.html.php');
define('PROYECTO_SHOW', dirname(__FILE__) . '/src/Proyectos/Views/Proyecto/show.html.php');
define('PROYECTO_ARCHIVE', dirname(__FILE__) . '/src/Proyectos/Views/Proyecto/archive.html.php');
define('PROYECTO_MINIMAL', dirname(__FILE__) . '/src/Proyectos/Views/Proyecto/minimal.html.php');
define('PROYECTO_PAGE', dirname(__FILE__) . '/src/Proyectos/Views/Proyecto/page.html.php');



define('INSCRIPCION_PROYECTO_NEW', dirname(__FILE__) . '/src/Proyectos/Views/InscripcionProyecto/new.html.php');
define('INSCRIPCION_PROYECTO_NEW_FORM', dirname(__FILE__) . '/src/Proyectos/Views/InscripcionProyecto/newForm.html.php');
define('INSCRIPCION_PROYECTO_EDIT', dirname(__FILE__) . '/src/Proyectos/Views/InscripcionProyecto/edit.html.php');
define('INSCRIPCION_PROYECTO_EDIT_FORM', dirname(__FILE__) . '/src/Proyectos/Views/InscripcionProyecto/editForm.html.php');
define('INSCRIPCION_PROYECTO_INDEX', dirname(__FILE__) . '/src/Proyectos/Views/InscripcionProyecto/index.html.php');
define('INSCRIPCION_PROYECTO_SHOW', dirname(__FILE__) . '/src/Proyectos/Views/InscripcionProyecto/show.html.php');
define('INSCRIPCION_PROYECTO_ARCHIVE', dirname(__FILE__) . '/src/Proyectos/Views/InscripcionProyecto/archive.html.php');
define('INSCRIPCION_PROYECTO_MINIMAL', dirname(__FILE__) . '/src/Proyectos/Views/InscripcionProyecto/minimal.html.php');
define('INSCRIPCION_PROYECTO_PAGE', dirname(__FILE__) . '/src/Proyectos/Views/InscripcionProyecto/page.html.php');



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





/* * ***************************************************************** */
?>
