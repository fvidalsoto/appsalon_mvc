<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<?php
include_once __DIR__ . "/../templates/alertas.php"
?>

<form method="post" action="/crear-cuenta" class="formulario">
    <div class="campo">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingresa tu nombre" value="<?php echo s($usuario->nombre) ?>">
    </div>
    <div class="campo">
        <label for="apellido">Apellido: </label>
        <input type="text" name="apellido" id="apellido" placeholder="Ingresa tu apellido" value="<?php echo s($usuario->apellido) ?>">
    </div>
    <div class="campo">
        <label for="telefono">Telefono: </label>
        <input type="tel" name="telefono" id="telefono" placeholder="Ingresa tu telefono" value="<?php echo s($usuario->telefono) ?>">
    </div>
    <div class="campo">
        <label for="email">Email: </label>
        <input type="email" name="email" id="email" placeholder="Ingresa tu email" value="<?php echo s($usuario->email) ?>">
    </div>
    <div class="campo">
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" placeholder="Ingresa tu password">
    </div>
    <div class="content-boton">
        <input type="submit" value="Crear cuenta" class="boton">
    </div>
</form>


<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Iniciar sesión</a>
    <a href="/olvide">¿Olvidaste tu password?</a>
</div>