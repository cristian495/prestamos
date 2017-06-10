<?php
if( isset($_GET['deleteSuccess'])){
    echo '<div style="color:green"> Eliminado correctamente </div>';
}
if(false != $_clientes) {
    $HTML ='<table>';
    foreach($_clientes as $id_cliente => $_clientesd)
    {
        $HTML .= '<tr><td>'.$_clientes[$id_cliente]['idCliente'].'</td>';
        $HTML.='<td>'.$_clientes[$id_cliente]['nombre'].'</td>
        <td>'.$_clientes[$id_cliente]['apellidoPaterno'].'</td>
        <td>'.$_clientes[$id_cliente]['apellidoMaterno'].'</td>
        <td>'.$_clientes[$id_cliente]['sexo'].'</td>
        <td>'.$_clientes[$id_cliente]['fechaNacimiento'].'</td>
        <td>'.$_clientes[$id_cliente]['dni'].'</td>
        <td>'.$_clientes[$id_cliente]['telefono'].'</td>
        <td>'.$_clientes[$id_cliente]['telefono2'].'</td>
        <td>'.$_clientes[$id_cliente]['direccion'].'</td>';

        if(isset($seleccionarCliente) and $seleccionarCliente == true)
        {

            if(isset($from) and $from == 'hacerPrestamo'){
                $HTML.= '<td><a href="?view=hacerPrestamo&clientSelected='.$_clientes[$id_cliente]['idCliente'].'">Seleccionar</a></td>';
            }elseif(isset($from) and $from == 'cobrar'){
                $HTML.= '<td><a href="?view=cobrar&clientSelected='.$_clientes[$id_cliente]['idCliente'].'">Seleccionar</a></td>';
            }
        }else{
            $HTML.='<td><a href="?view=cliente&mode=edit&id='.$_clientes[$id_cliente]['idCliente'].'">Editar</a></td>
                <td><a onClick="DeleteItem(\'¿Esta seguro de eliminar este cliente?\',\'?view=cliente&mode=delete&id='.$_clientes[$id_cliente]['idCliente'].'\')">Eliminar</a></td>';
        }
        $HTML.= '</tr>';

    }
    $HTML.= '</table>';
} else
{
    $HTML = '<div class="alert alert-dismissible alert-info"><strong>INFORMACIÓN: </strong> Todavía no existe ninguna cliente.</div>';
}

echo $HTML;
?>
<script>
    function DeleteItem(contenido,url) {
        var action = window.confirm(contenido);
        if (action) {
            window.location = url;
        }
    }
</script>