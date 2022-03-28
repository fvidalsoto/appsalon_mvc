<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php
include_once __DIR__ . "/../templates/alertas.php"
?>

<form class="formulario" action="/" method="post">

    <div class="campo">
        <label for="email">Email: </label>
        <input type="email" id="email" name="email" placeholder="Ingresa tu email" value="<?php echo s($auth->email) ?>">
    </div>

    <div class="campo">
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" placeholder="Ingresa tu password">
    </div>

    <div class="content-boton">
        <input type="submit" class="boton" value="Iniciar sesión">
    </div>

</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una.</a>
    <a href="/olvide">¿Olvidaste tu password?</a>
</div>