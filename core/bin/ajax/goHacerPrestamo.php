<?php



if (!empty($_POST['idCliente']) and
    !empty($_POST['montoPrestamo']) and
    !empty($_POST['fechaInicialPrestamo']) and
    !empty($_POST['frecuenciaPago']) and
    !empty($_POST['numCuotas']) and
    !empty($_POST['fechaVencimientoPrestamo']) and
    !empty($_POST['interes'])
) {

    include('core/functions/detallePrestamo.php');

    /*** FUNCION PARA CALCULAR LOS MONTOS DE PAGO ***/

    function calcularMontos($montoAcordado, $interes, $cuotas)
    {
        /*CUOTA SIN INTERÉS*/
        $montoCuota = floatval($montoAcordado) / intval($cuotas);
        $montoCuota = round($montoCuota,2);

        /*INTERÉS*/
        $interesCadaCuota = $montoCuota * (floatval($interes) * 0.01);
        $interesCadaCuota = round($interesCadaCuota,2);

        /*CUOTAS + INTERÉS*/
        $montoCuotaIncluidoInteres = $montoCuota + $interesCadaCuota;
        $montoCuotaIncluidoInteres = round($montoCuotaIncluidoInteres,2);

        /*PAGO TOTAL SIN INTERÉS*/
        $pagoTotalSinteres = floatval($montoCuota);

        /*PAGO TOTAL CON INTERESES*/
        $pagoTotalCinteres = $montoCuotaIncluidoInteres * intval($cuotas);

        $montos = array(
            'cuotaSinteres' => $montoCuota,
            'porcentajeInteres' => $interes,
            'interesCuota' => $interesCadaCuota,
            'cuotaCinteres' => $montoCuotaIncluidoInteres,
            'pagoTotalSInteres' => $pagoTotalSinteres,
            'pagoTotalCInteres' => $pagoTotalCinteres,
        );

        return $montos;
    }

    /*******************************/


    //$montoCuotas = calcularCuotas($_POST['montoPrestamo'], $_POST['interes'], $_POST['numCuotas']);


    /******FUNCIONES PARA CALCULAR FECHAS DE PAGO *********/

    function forFechas($fechaInicial, $numCuotas, $dias)
    {
        list($year, $mon, $day) = explode('-', $fechaInicial);
        $numFrecuencia = $dias;

        for ($i = 1; $i <= $numCuotas; $i++) {
            $fechaSiguiente = date('d/m/Y', mktime(0, 0, 0, $mon, $day + $numFrecuencia, $year));

            $arrayFechas[$i] = array(
                'fecha' => $fechaSiguiente
            );
            $numFrecuencia = $numFrecuencia + $dias;
        }

        return $arrayFechas;
    }

    function calcularFechasPago($fechaInicial, $numCuotas, $frecuenciaPago)
    {

        switch ($frecuenciaPago) {

            case 'diario':
                $dias = 1;
                return forFechas($fechaInicial, $numCuotas, $dias);
                break;

            case 'semanal':
                $dias = 7;
                return forFechas($fechaInicial, $numCuotas, $dias);
                break;

            case 'quincenal':
                $dias = 15;
                return forFechas($fechaInicial, $numCuotas, $dias);
                break;

            case 'mensual':
                $dias = 30;
                return forFechas($fechaInicial, $numCuotas, $dias);
                break;

            default:
                return null;
                break;
        }
        //date('d-m-Y', strtotime('+5 day'));
    }

    /***********************************/


    /*************TABLA DE RESULTADOS **************/
    $tablaHTML = '
    <table border="1" style="border-collapse:collapse;">
        <tr>
            <td>Cuota</td>
            <td>Fecha de pago de cuota</td>
            <td>% interés</td>
            <td>interés</td>
            <td>cuota + interes</td>
            <td>Estado</td>
            <td>Forma de pago</td>
        </tr>
    ';

    /**************************************************/


    /**** ARRAY CON LAS FECHAS DE PAGO*/
    $_fechas = calcularFechasPago($_POST['fechaInicialPrestamo'], $_POST['numCuotas'], $_POST['frecuenciaPago']);

    /**** ARRAY CON TODOS LOS MONTOS CALCULADOS*/
    $_montos = calcularMontos($_POST['montoPrestamo'], $_POST['interes'], $_POST['numCuotas']);


    /******* RECORRER ARRAY DE FECHAS DE PAGO Y MOSTRAR RESULTADOS ********/
    /*******
     * numCuota,
     * fechaPagoCuota,
     * %interes,
     * interesporcuota,
     * montoCuota+interes,
     * estado,
     * formaDePago
     ********/

    foreach ($_fechas as $clave => $fecha) {
        $tablaHTML .= '
        <tr>
            <td>' . $clave . '</td>
            <td>' . $fecha['fecha'] . '</td>
            <td>' . $_POST['interes'].' %' . '</td>
            <td>' . $_montos['interesCuota'] . '</td>
            <td>' . $_montos['cuotaCinteres'] . '</td>
            <td> Pendiente </td>
            <td>' . $_POST['frecuenciaPago'] . '</td>
        </tr>';

    }
    $tablaHTML .= '</table>';

    echo $tablaHTML;

    /*VARIABLE GLOBAL CON TODOS LOS DETALLES DEL PRESTAMO CALCULADO*/
    setDetallePrestamo($_POST['idCliente'],$_montos,$_fechas,$_POST['frecuenciaPago'],$_POST['numCuotas'],'pendiente');
} else {

    echo '<strong>ERROR:</strong> Todos los datos deben estar llenos.';
    echo '<script>document.getElementById(\'btnRealizarPrestamo\').disabled = true</script>';
}


