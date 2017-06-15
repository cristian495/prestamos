<?php

class Prestamo{
    private $db,
            $montoAcordado,
            $fechaInicial,
            $frecuenciaPago,
            $numeroCuotas,
            $fechaFinal,
            $interes,
            $estado,
            $idCliente;


    function __construct()
    {
        $this->db = new Conexion();
    }

    private function Errors($url) {
        try {
            //ID CLIENTE
            if(empty($_POST['idCliente'])) {
                throw new Exception(1);
            } else {
                $this->idCliente = $this->db->real_escape_string($_POST['idCliente']);
            }

            //MONTO A PRESTAR
            if(empty($_POST['montoP'])) {
                throw new Exception(2);
            } else {
                $this->montoAcordado = $this->db->real_escape_string($_POST['montoP']);
            }

            //FECHA INICIAL DEL PRESTAMO
            if(empty($_POST['fechaInicialP'])) {
                throw new Exception(3);
            } else {
                $this->fechaInicial = $this->db->real_escape_string($_POST['fechaInicialP']);
            }

            //FRECUENCIA DE PAGOS DE CUOTA
            if(empty($_POST['frecuenciaPago'])) {
                throw new Exception(4);
            } else {
                $this->frecuenciaPago = $this->db->real_escape_string($_POST['frecuenciaPago']);
            }

            //CANTIDAD DE CUOTAS
            if(empty($_POST['numCuotasP'])) {
                throw new Exception(5);
            } else {
                $this->numeroCuotas = $this->db->real_escape_string($_POST['numCuotasP']);
            }

            //INTERES POR CUOTA
            if(empty($_POST['interesP'])) {
                throw new Exception(6);
            } else {
                $this->interes = $this->db->real_escape_string($_POST['interesP']);
            }

        } catch(Exception $error) {
            header('location: '.$url .$error->getMessage());
            exit;
        }
    }




    /*** FUNCION PARA CALCULAR LOS MONTOS DE PAGO ***/
    private function calcularMontos($montoAcordado, $interes, $cuotas)
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
            'porcentajeInteres' => intval($interes),
            'interesCuota' => $interesCadaCuota,
            'cuotaCinteres' => $montoCuotaIncluidoInteres,
            'pagoTotalSInteres' => $pagoTotalSinteres,
            'pagoTotalCInteres' => $pagoTotalCinteres,
        );

        return $montos;
    }
    /**************************************/


    /******FUNCIONES PARA CALCULAR FECHAS DE PAGO *********/

    private function forFechas($fechaInicial, $numCuotas, $dias)
    {
        list($year, $mon, $day) = explode('-', $fechaInicial);
        $numFrecuencia = $dias;

        for ($i = 1; $i <= $numCuotas; $i++) {
            $fechaSiguiente = date('d-m-Y', mktime(0, 0, 0, $mon,$day + $numFrecuencia , $year));

            //Paso al formato de la BD YYYY-m-d
            list($newDay,$newMon,$newYear) = explode('-',$fechaSiguiente);
            $newFechaSiguien = $newYear.'-'.$newMon.'-'.$newDay;

            $arrayFechas[$i] = array(
                'fecha' => $newFechaSiguien
            );
            $numFrecuencia = $numFrecuencia + $dias;
        }

        return $arrayFechas;
    }

    private function calcularFechasPago($fechaInicial, $numCuotas, $frecuenciaPago)
    {

        switch ($frecuenciaPago) {

            case 'diario':
                $dias = 1;
                return $this->forFechas($fechaInicial, $numCuotas, $dias);
                break;

            case 'semanal':
                $dias = 7;
                return $this->forFechas($fechaInicial, $numCuotas, $dias);
                break;

            case 'quincenal':
                $dias = 15;
                return $this->forFechas($fechaInicial, $numCuotas, $dias);
                break;

            case 'mensual':
                $dias = 30;
                return $this->forFechas($fechaInicial, $numCuotas, $dias);
                break;

            default:
                return null;
                break;
        }
        //date('d-m-Y', strtotime('+5 day'));
    }

    /***********************************/



    /******* INSERTAR A LA BASE DE DATOS *********/
    public function Add(){

        /** VALIDACION DE VALORES*/
        if(isset($_POST['idCliente']) and !empty($_POST['idCliente']))
        {
            $this->Errors('?view=prestamo&clientSelected='.$_POST['idCliente'].'&error=');
        }else{
            $this->Errors('?view=prestamo&error=');
        }
        /****************************/

        // CARGAR ARRAYS CON MONTOS Y FECHAS
        $_montos = $this->calcularMontos($this->montoAcordado,$this->interes,$this->numeroCuotas);
        $_fechas = $this->calcularFechasPago($this->fechaInicial,$this->numeroCuotas,$this->frecuenciaPago);

        //var_dump($_fechas);
        /*echo 'MONTOS '.'<br>';
        echo 'porcentaje interes : '.$_montos['porcentajeInteres'],' % <br>';
        echo 'interes cuota: '.$_montos['interesCuota'],'<br>';
        echo 'cuota: '.$_montos['cuotaSinteres'],'<br>';
        echo 'interes + cuota: '.$_montos['cuotaCinteres'],'<br>';
        echo 'todo incluido interes: '.$_montos['pagoTotalCInteres'],'<br><br>';*/


        /*** VALORES PARA LA TABLA PRESTAMO ***/
        $values=floatval($this->montoAcordado).
            ',\''.$this->fechaInicial.'\','.
            '\''.$this->frecuenciaPago.'\''.
            ','.intval($this->numeroCuotas).
            ',\''.end(end($_fechas)).'\','.
            floatval($this->interes).
            ','.intval($this->idCliente);
        $query = 'INSERT INTO prestamo(montoAcordado,fechaInicial,frecuenciaPago,numeroCuotas,fechaFinal,interes,CLIENTE_idCliente)
                        VALUES('.$values.')';
        /*************************************/

        $this->db->query($query)or die ('error en la insercion' . $this->db->errno . '  ' . $this->db->error);


        /*** OBTENER ID DEL ULTIMO PRESTAMO (DEL QUE SE ACABA DE HACER)****/

        $sql_idPrestamo = $this->db->query("SELECT idprestamo FROM prestamo
                                            WHERE CLIENTE_idCliente='$this->idCliente'
                                            ORDER BY idprestamo DESC LIMIT 1;") or die ('error en la SELECCION' . $this->db->errno . '  ' . $this->db->error);
        if($this->db->rows($sql_idPrestamo) > 0) {
            $data_t = $this->db->recorrer($sql_idPrestamo);
            $id_ultimo_prestamo = $data_t[0];
        }
        /******************************************************************/


        /********* VALORES PARA LA TABLA CUOTAS *********/
        $query2='';
        for($i=1; $i<=count($_fechas); $i++){
            /*** VALORES PARA LA TABLA CUOTAS ***/
            $values2 = '\''.$_fechas[$i]['fecha'].'\','.
                       $_montos['cuotaCinteres'].','.
                       intval($id_ultimo_prestamo);

            $query2 .= 'INSERT INTO cuotas(fechaPago,montoPagar,PRESTAMO_idprestamo)
                        VALUES ('.$values2.');';
        }
        /************************************************/

        $this->db->multi_query($query2)or die ('error en la insercion' . $this->db->errno . '  ' . $this->db->error);




        header('Location: ?view=prestamo&prestamo=true');
    }
    /*******************************************/
}
/**
ALTER TABLE `prestamo`
DROP FOREIGN KEY `fk_PRESTAMO_cliente`;
ALTER TABLE `prestamo`
ADD CONSTRAINT `fk_prestamo_cliente`
    FOREIGN KEY (`CLIENTE_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE;
*/