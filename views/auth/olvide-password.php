<h1 class="nombre-pagina">Olvide mi password</h1>
<p class="descripcion-pagina">Restablece tu password escribiendo tu email a continuación</p>

<?php
include_once __DIR__ . "/../templates/alertas.php"
?>

<form action="/olvide" method="post" class="formulario">

    <div class="campo">
        <label for="email" name="email" id="email">Email: </label>
        <input type="email" name="email" id="email" placeholder="Ingresa tu email">
    </div>

    <div class="content-boton">
        <input type="submit" value="Enviar instrucciones" class="boton">
    </div>

</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una.</a>
    <a href="/">¿Ya tenes una cuenta? Inicia sesión</a>
</div>