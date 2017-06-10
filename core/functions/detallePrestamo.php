<?php

$detallePrestamo=[];
function setDetallePrestamo($idCliente,
                            $montos,
                            $fechasPago,
                            $frecuenciaPago,
                            $numCuotas,
                            $estado)
{
    global $detallePrestamo;
    $detallePrestamo = array(
                            'idCliente' => $idCliente,
                            'montos'=> $montos,
                            'fechasPago' => $fechasPago,
                            'frecuenciaPago' => $frecuenciaPago,
                            'numCuotas' => $numCuotas,
                            'estadoPago' => $estado
                            );

}


function getDetallePrestamo()
{
    global $detallePrestamo;
    var_dump($detallePrestamo);
    return $detallePrestamo;
/*
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';

    echo 'idcliente: '.$detallePrestamo['idCliente'].'<br><br>';

    echo 'MONTOS '.'<br>';
    echo 'porcentaje interes : '.$detallePrestamo['montos']['porcentajeInteres'],' % <br>';
    echo 'interes cuota: '.$detallePrestamo['montos']['interesCuota'],'<br>';
    echo 'cuota: '.$detallePrestamo['montos']['cuotaSinteres'],'<br>';
    echo 'interes + cuota: '.$detallePrestamo['montos']['cuotaCinteres'],'<br>';
    echo 'todo incluido interes: '.$detallePrestamo['montos']['pagoTotalCInteres'],'<br><br>';

    echo 'FECHAS '.'<br>';
    echo 'cuota 1: '.$detallePrestamo['fechasPago']['1']['fecha'],'<br>';
    echo 'cuota 2: '.$detallePrestamo['fechasPago']['2']['fecha'],'<br>';
    echo 'cuota 3: '.$detallePrestamo['fechasPago']['3']['fecha'],'<br><br>';

    echo 'FRECUENCIA PAGO '.'<br>';
    echo 'frecuencia: '.$detallePrestamo['frecuenciaPago'].'<br><br>';

    echo 'NUM CUOTAS '.'<br>';
    echo 'cantidad cuotas: '.$detallePrestamo['numCuotas'].'<br><br>';

    echo 'ESTADO CUOTAS '.'<br>';
    echo 'estado cuotas: '.$detallePrestamo['estadoPago'].'<br><br>';*/
}
