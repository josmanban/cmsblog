<?php
isset($_SESSION['usuario']) && $_SESSION['usuario']->esAdministrador() ? require_once HEADER_ADMIN : require_once HEADER;
require_once CONTENT;
?>
<article>
    <header>
        <h2>Perfil publico</h2>
    </header>
    <p>
    <dl class="dl-horizontal">
        <dt>
        </dt>
        <dd> 
            <img class="img-rounded img-thumbnail" src="<?php
                 echo $usuario->getPerfil()->getAvatar()
                 ;
                 ?>"/>
        </dd>
        <dt>
        Nombre usuario:
        </dt>
        <dd>           
            <?php echo $usuario->getNombre(); ?>
        </dd>
        <dt>
        Descripcion
        </dt>
        <dd>       
            <?php echo $usuario->getPerfil()->getDescripcion(); ?>
        </dd>
    </dl>

</p>
</article>
<?php if ($perfilCompleto): ?>
    <article>
        <header>
            <h2>Datos privados</h2>
            <p>
            <dl class="dl-horizontal">
                <dt>Email:<dt>
                <dd><?php echo $usuario->getEmail(); ?></dd>
            </dl>
            <?php Librerias\View::render(PERSONA_PAGE, array('persona' => $usuario->getPersona())) ?>
            </p>

        </header>
    </article>
<?php endif; ?>
<?php
require_once MENSAJES;
require_once ASIDE;
require_once FOOTER;
?>


