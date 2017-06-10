<!--action="?view=hacerPrestamo"-->
<?php
if(isset($_GET['error'])) {
    if($_GET['error'] == 1) {
        echo '<h4 style="color:red;">Debe seleccionar un cliente</h4>';
    } else if ($_GET['error'] == 2) {
        echo '<h4 style="color:red;">Cantidad a prestar invalida</h4>';
    } else if ($_GET['error'] == 3){
        echo '<h4 style="color:red;">fecha inicial invalida</h4>';
    }else if ($_GET['error'] == 4){
        echo '<h4 style="color:red;">frecuencia de pago invalida</h4>';
    }else if ($_GET['error'] == 5){
        echo '<h4 style="color:red;">numero de cuotas invalida</h4>';
    }else if ($_GET['error'] == 6){
        echo '<h4 style="color:red;">interès invalido</h4>';
    }
}

if(isset($_GET['prestamo']) and $_GET['prestamo']=true) {
    echo '<h4 style="color:green;">Prestamo realizado correctamente</h4>';
}
?>
<form  method="post" action="?view=hacerPrestamo&mode=prestamoConfirmado" id="frmPrestamo">
    <label for="selecCliente">Seleccionar Cliente</label>
    <a target="_self" href="?view=cliente&from=hacerPrestamo&mode=seeAll&seleccionar=true">buscar</a><br>
    <?php


    if (isset($_GET['clientSelected']) and array_key_exists($_GET['clientSelected'], $_clientes)) {
        ?>

        <label for="nombreClienteSelec">Nombre Cliente</label>
        <input type="text" readonly="readonly" name="nombreP"
               value="<?php echo $_clientes[$_GET['clientSelected']]['nombre']; ?>"/>

        <label for="dniClienteSelec">DNI Cliente</label>
        <input type="text" readonly="readonly" name="dniP"
               value="<?php echo $_clientes[$_GET['clientSelected']]['dni']; ?>"/>

        <input type="hidden" name="idCliente"value="<?php echo $_clientes[$_GET['clientSelected']]['idCliente']; ?>" id="idCliente"/>
    <?php
    }
    ?>
    <label for="montoPrestamo">Monto:</label>
    <input type="text" name="montoP" id="montoPrestamo"/>

    <label for="fechaInicialPrestamo">Fecha que se hace el prestamo</label>
    <input name="fechaInicialP" type="date" id="fechaInicialPrestamo" value="<?php echo  date('Y-m-d')?>"/>

    <label for="frecuenciaPago">Frecuencia pago:</label>
    <select name="frecuenciaPago" id="frecuenciaPago">
        <option value="diario">Diario</option>
        <option value="semanal">Semanal</option>
        <option value="quincenal">Quincenal</option>
        <option value="mensual">Mensual</option>
    </select>

    <label for="numCuotas">Numero de Cuotas</label>
    <input type="number" name="numCuotasP" id="numCuotas"/>


    <label for="fechaVencimientoPrestamo">fecha vencimiento del prestamo</label>
    <input type="text" name="fechaVencimientoP" id="fechaVencimientoPrestamo" readonly="readonly"/>

    <label for="interes">% Interés</label>
    <input type="number" name="interesP" id="interes" step="1"/>

    <input type="button" value="CALCULAR" onclick="hacerPresamo()"/>
</form>

<div class="resultadosPrestamo" id="resultadosPrestamo">

</div>
<input  onclick="makeSubmit();" type="submit" disabled id="btnRealizarPrestamo" value="Realizar prestamo"/>
<script>
    /*if(document.getElementsByTagName('table').length!=0){
        document.getElementById('btnRealizarPrestamo').disabled = false;
    }*/


    function makeSubmit(){
        /*if(document.getElementsByTagName('table').length!=0){
            document.getElementById('btnRealizarPrestamo').disabled = false;
        }*/
        document.getElementById('frmPrestamo').submit();
    }


    //01/07/2014
    //2017/05/1
    //"01/06/2017"
    sumaFecha = function (d, fecha) {
        var Fecha = new Date();
        var sFecha = fecha || (Fecha.getFullYear() + "/" + (Fecha.getMonth() + 1) + "/" + Fecha.getDate());
        var sep = sFecha.indexOf('/') != -1 ? '/' : '-';
        var aFecha = sFecha.split(sep);
        var fecha = aFecha[0] + '/' + aFecha[1] + '/' + aFecha[2];
        fecha = new Date(fecha);
        fecha.setDate(fecha.getDate() + parseInt(d));
        var anno = fecha.getFullYear();
        var mes = fecha.getMonth()+1;
        var dia = fecha.getDate();
        mes = (mes < 10) ? ("0" + mes) : mes;
        dia = (dia < 10) ? ("0" + dia) : dia;
        var fechaFinal = dia + ' / ' + mes + ' / ' + anno;
        return (fechaFinal);
    }

    let fechaInicial = document.getElementById('fechaInicialPrestamo');
    let frecuenciaPago = document.getElementById('frecuenciaPago');
    let cuotas = document.getElementById('numCuotas');
    let fechaVencimiento = document.getElementById('fechaVencimientoPrestamo');
    let numFrecuencia = 1;
    let resultadoFinPago;


    cuotas.addEventListener('change', function (e) {

        var meses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        if (fechaInicial.value != "" && frecuenciaPago.value != "") {
            if (cuotas.value != '') {
                if (frecuenciaPago.value === 'diario') {
                    numFrecuencia = 1;
                    for (var i = 1; i <= cuotas.value; i++) {
                        console.log(sumaFecha(numFrecuencia, fechaInicial.value));
                        resultadoFinPago = sumaFecha(numFrecuencia, fechaInicial.value);
                        numFrecuencia = numFrecuencia + 1;
                    }
                    fechaVencimiento.value = resultadoFinPago;

                } else if (frecuenciaPago.value === 'semanal') {
                    numFrecuencia = 7;
                    for (var s = 1; s <= cuotas.value; s++) {
                        console.log(sumaFecha(numFrecuencia, fechaInicial.value));
                        resultadoFinPago = sumaFecha(numFrecuencia, fechaInicial.value);
                        numFrecuencia = numFrecuencia + 7;
                    }
                    fechaVencimiento.value = resultadoFinPago;

                } else if (frecuenciaPago.value === 'quincenal') {
                    numFrecuencia = 15;
                    for (var q = 1; q <= cuotas.value; q++) {
                        console.log(sumaFecha(numFrecuencia, fechaInicial.value));
                        resultadoFinPago = sumaFecha(numFrecuencia, fechaInicial.value);
                        numFrecuencia = numFrecuencia + 15;
                    }
                    fechaVencimiento.value = resultadoFinPago;

                } else if (frecuenciaPago.value === 'mensual') {
                    numFrecuencia = 30;
                    for (var m = 1; m <= cuotas.value; m++) {
                        console.log(sumaFecha(numFrecuencia, fechaInicial.value));
                        resultadoFinPago = sumaFecha(numFrecuencia, fechaInicial.value);
                        numFrecuencia = numFrecuencia + 30;
                    }
                    fechaVencimiento.value = resultadoFinPago;

                }

            }

        }
    })


    function hacerPresamo()
    {

        let connect, form, response, result;
        let idCliente, montoPrestamo, fechaInicialPrestamo, frecuenciaPago, numCuotas, fechaVencimientoPrestamo, interes;



        idCliente = document.getElementById('idCliente').value;
        montoPrestamo = document.getElementById('montoPrestamo').value;
        fechaInicialPrestamo = document.getElementById('fechaInicialPrestamo').value;
        frecuenciaPago = document.getElementById('frecuenciaPago').value;
        numCuotas = document.getElementById('numCuotas').value;
        fechaVencimientoPrestamo = document.getElementById('fechaVencimientoPrestamo').value;
        interes = document.getElementById('interes').value;


        form = 'idCliente=' + idCliente +
               '&montoPrestamo=' + montoPrestamo +
               '&fechaInicialPrestamo=' + fechaInicialPrestamo +
               '&frecuenciaPago=' + frecuenciaPago +
               '&numCuotas=' + numCuotas +
               '&fechaVencimientoPrestamo=' + fechaVencimientoPrestamo +
               '&interes=' + interes;

        connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        connect.onreadystatechange = function ()
        {
            if(connect.readyState == 4 && connect.status == 200)
            {
                if(connect.responseText == 1)
                {
                    result += '<p><strong>Estamos redireccionandote...</strong></p>';
                    document.getElementById('resultadosPrestamo').innerHTML = result;
                } else
                {
                    document.getElementById('resultadosPrestamo').innerHTML = connect.responseText;
                }
            } else if(connect.readyState != 4)
            {

                result += '<h4>Procesando...</h4>';
                document.getElementById('resultadosPrestamo').innerHTML = result;
                document.getElementById('btnRealizarPrestamo').disabled = false;
            }
        }
        connect.open('POST','ajax.php?mode=hacerPrestamo',true);
        connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        connect.send(form);

    }
</script>