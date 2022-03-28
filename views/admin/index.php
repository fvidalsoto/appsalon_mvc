<h1 class="nombre-pagina">Panel de administracion</h1>

<?php
include_once __DIR__ . '/../templates/barra.php'
?>

<h2>Buscar Citas</h2>
<div class="busqueda">
    <form action="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" class="form-control" value="<?php echo $fecha ?>">
        </div>
    </form>

</div>


<?php
if (count($citas) === 0) {
    echo "<h2 class='no-citas'> No hay citas en esta fecha </h2>";
}
?>



<div class="" id=" citas-admin">

    <ul class="citas">
        <?php
        $idCita = 0;
        foreach ($citas as $key => $cita) :
            if ($idCita !== $cita->id) :
                $total = 0;
        ?>

                <li>
                    <p>ID: <span><?php echo $cita->id; ?> </span></p>
                    <p>Hora: <span><?php echo $cita->hora; ?> </span></p>
                    <p>Cliente: <span><?php echo $cita->cliente; ?> </span></p>
                    <p>Email: <span><?php echo $cita->email; ?> </span></p>
                    <p>Telefono: <span><?php echo $cita->telefono; ?> </span></p>
                    <h3>Servicios</h3>
                <?php
                $idCita = $cita->id;
            endif; ?>
                <p class="servicio"> <?php echo $cita->servicio . " $" . $cita->precio; ?> </p>

                <?php
                $total += $cita->precio;
                $actual = $cita->id;
                $proximo = $citas[$key + 1]->id ?? '';

                if (esUltimo($actual, $proximo)) {
                ?>
                    <p class="total">Total: <span>$<?php echo $total; ?> </span></p>

                    <form action="/api/eliminar" method="post">
                        <input type="hidden" name="id" value="<?php echo $cita->id ?>">
                        <!--                         <input type="submit" class="boton-eliminar " value="eliminar"> -->
                        <input type="submit" class="boton-eliminar " value="Eliminar 🗑">

                    </form>
                <?php
                }
                ?>




            <?php endforeach; ?>
                </li>
    </ul>
</div>

<?php $script = "<script src='build/js/buscador.js'> </script> "; ?>