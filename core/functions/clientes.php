<?php

function clientes(){
    $clientes = array();
    $bd = new Conexion();
    $sqlResultado = $bd->query("SELECT * FROM cliente");
    if($bd->rows($sqlResultado) > 0){
        while($data = $bd->recorrer($sqlResultado)){
            $clientes[$data['idCliente']] = $data;
        }
    }else{
        $clientes = false;
    }


    return $clientes;
}

?>