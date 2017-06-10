<?php
if(isset($_GET['success'])) {
    echo '<div style="color:green"> Cliente editado  correctamente </div>';
}

if(isset($_GET['error'])) {
    echo '<div style="color:red"> error al editar </div>';
}
?>
<form action="?view=cliente&mode=edit&id=<?php echo $_GET['id']?>" method="POST" enctype="application/x-www-form-urlencoded">
    <label for="idCliente">id</label>
    <input type="text" name="idCliente" id="idCliente" value="<?php echo $_clientes[$_GET['id']]['idCliente']; ?>" readonly/>

    <label for="nombreCliente">Nombre</label>
    <input type="text" name="nombreCliente" id="nombreCliente" value="<?php echo $_clientes[$_GET['id']]['nombre']; ?>"/>

    <label for="apellidoPaterno">Apellido Paterno</label>
    <input type="text" name="apellidoPaternoCliente" id="apellidoPaternoCliente" value="<?php echo $_clientes[$_GET['id']]['apellidoPaterno']; ?>"/>

    <label for="apellidoMaterno">Apellido Materno</label>
    <input type="text" name="apellidoMaternoCliente" id="apellidoMaternoCliente" value="<?php echo $_clientes[$_GET['id']]['apellidoMaterno']; ?>"/>

    <label for="sexoCliente">Sexo</label>
    <select name="sexoCliente" id="sexoCliente" value="<?php echo $_clientes[$_GET['id']]['sexo']; ?>" >
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
    </select>

    <label for="fechaNacimientoCliente">Fecha Nacimiento</label>
    <input type="date"  name="fechaNacimientoCliente" id="fechaNacimientoCliente" value="<?php echo $_clientes[$_GET['id']]['fechaNacimiento']; ?>"/>

    <label for="dniCliente">Dni</label>
    <input type="text"  name="dniCliente" id="dniCliente" value="<?php echo $_clientes[$_GET['id']]['dni']; ?>"/>

    <label for="telefonoCliente">Telefono</label>
    <input type="text"  name="telefonoCliente" id="telefonoCliente" value="<?php echo $_clientes[$_GET['id']]['telefono']; ?>"/>

    <label for="telefono2Cliente">Telefono 2</label>
    <input type="text"  name="telefono2Cliente" id="telefono2Cliente" value="<?php echo $_clientes[$_GET['id']]['telefono2']; ?>"/>

    <label for="direccionCliente">Direccion</label>
    <input type="text"  name="direccionCliente" id="direccionCliente" value="<?php echo $_clientes[$_GET['id']]['direccion']; ?>"/>

    <input type="submit" id="submitRegistrarCliente" value="Editar"/>
</form>

