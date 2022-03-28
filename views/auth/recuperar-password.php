<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuacion</p>

<?php
include_once __DIR__ . "/../templates/alertas.php"
?>

<?php if ($error) return null; ?>

<form method="post" class="formulario">
    <div class="campo">
        <label for="password">Ingresa tu password</label>
        <input type="password" name="password" id="password" placeholder="Tu nuevo password">
    </div>

    <div class="content-boton">
        <input type="submit" class="boton" value="Guardar nuevo password">
    </div>
</form>

<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Iniciar sesion.</a>
    <a href="/crear-cuenta">¿Aún no tienes cuenta? Obtener una</a>
</div>