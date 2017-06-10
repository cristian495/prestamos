<?php

if(false != $arrayClientes) {
    $HTML ='<table>';
    foreach($arrayClientes as $id_cliente => $_clientes) {
        $HTML .= '<tr><form action="?view=hacerPrestamo" method="POST">
        <td>'.$arrayClientes[$id_cliente]['idCliente'].'</td>';


        $HTML.='<td><input type=hidden name="idClienteSeleccionado" value="'.$arrayClientes[$id_cliente]['idCliente'].'"/></td>';
        $HTML.='<td><input type=hidden name="nombreClienteSeleccionado" value="'.$arrayClientes[$id_cliente]['nombre'].'"/></td>';
        $HTML.='<td><input type=hidden name="paternoClienteSeleccionado" value="'.$arrayClientes[$id_cliente]['apellidoPaterno'].'"/></td>';
        $HTML.='<td><input type=hidden name="maternoClienteSeleccionado" value="'.$arrayClientes[$id_cliente]['apellidoMaterno'].'"/></td>';
        $HTML.='<td><input type=hidden name="sexoClienteSeleccionado" value="'.$arrayClientes[$id_cliente]['sexo'].'"/></td>';
        $HTML.='<td><input type=hidden name="fechaNacClienteSeleccionado" value="'.$arrayClientes[$id_cliente]['fechaNacimiento'].'"/></td>';
        $HTML.='<td><input type=hidden name="dniClienteSeleccionado" value="'.$arrayClientes[$id_cliente]['dni'].'"/></td>';
        $HTML.='<td><input type=hidden name="telefonoClienteSeleccionado" value="'.$arrayClientes[$id_cliente]['telefono'].'"/></td>';
        $HTML.='<td><input type=hidden name="direccionClienteSeleccionado" value="'.$arrayClientes[$id_cliente]['direccion'].'"/></td>';
        $HTML.='<td>'.$arrayClientes[$id_cliente]['nombre'].'</td>
        <td>'.$arrayClientes[$id_cliente]['apellidoPaterno'].'</td>
        <td>'.$arrayClientes[$id_cliente]['apellidoMaterno'].'</td>
        <td>'.$arrayClientes[$id_cliente]['sexo'].'</td>
        <td>'.$arrayClientes[$id_cliente]['fechaNacimiento'].'</td>
        <td>'.$arrayClientes[$id_cliente]['dni'].'</td>
        <td>'.$arrayClientes[$id_cliente]['telefono'].'</td>
        <td>'.$arrayClientes[$id_cliente]['telefono2'].'</td>
        <td>'.$arrayClientes[$id_cliente]['direccion'].'</td>';
        $HTML.='<td><input type="submit" value="seleccionar"></td></form></tr>';


    }
    $HTML.= '</table>';
} else {
    $HTML = '<div class="alert alert-dismissible alert-info"><strong>INFORMACIÓN: </strong> Todavía no existe ninguna cliente.</div>';
}

echo $HTML;