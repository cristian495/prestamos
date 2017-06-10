<?php
if(isset($_GET['success'])) {
    echo '<div style="color:green"> Insertado correctamente </div>';
}

if(isset($_GET['error'])) {
    echo '<div style="color:red"> error al insertar </div>';
}
?>

<form action="?view=cliente&mode=add" method="POST" enctype="application/x-www-form-urlencoded">
    <label for="nombreCliente">Nombre</label>
    <input type="text" name="nombreCliente" id="nombreCliente"/>

    <label for="apellidoPaterno">Apellido Paterno</label>
    <input type="text" name="apellidoPaternoCliente" id="apellidoPaternoCliente"/>

    <label for="apellidoMaterno">Apellido Materno</label>
    <input type="text" name="apellidoMaternoCliente" id="apellidoMaternoCliente"/>

    <label for="sexoCliente">Sexo</label>
    <select name="sexoCliente" id="sexoCliente">
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
    </select>

    <label for="fechaNacimientoCliente">Fecha Nacimiento</label>
    <input type="date"  name="fechaNacimientoCliente" id="fechaNacimientoCliente"/>

    <label for="dniCliente">Dni</label>
    <input type="text"  name="dniCliente" id="dniCliente"/>

    <label for="telefonoCliente">Telefono</label>
    <input type="text"  name="telefonoCliente" id="telefonoCliente"/>

    <label for="telefono2Cliente">Telefono 2</label>
    <input type="text"  name="telefono2Cliente" id="telefono2Cliente"/>

    <label for="direccionCliente">Dni</label>
    <input type="text"  name="direccionCliente" id="direccionCliente"/>

    <input type="submit" id="submitRegistrarCliente"/>
</form>