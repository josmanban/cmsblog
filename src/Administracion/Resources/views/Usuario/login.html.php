<?php
require_once HEADER;
require_once CONTENT_ONE_COLUMN;
?>


<div class="">
    <h2>Login</h2>
    <form role="form" action="index.php?controller=usuario&action=login" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Nombre usuario:</label>
            <input type="text" class="form-control" name="nombre">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password:</label>
            <input type="password" class="form-control" name="password">
        </div>

        <button type="submit" class="btn btn-primary">Aceptar</button>
    </form>
</div>

<?php
require_once MENSAJES;
require_once FOOTER_ONE_COLUMN;
?>



