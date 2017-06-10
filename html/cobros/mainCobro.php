<form  method="post" action="?view=hacerPrestamo&mode=prestamoConfirmado" id="frmPrestamo">
    <label for="selecCliente">Seleccionar Cliente</label>
    <a target="_self" href="?view=cliente&from=cobrar&mode=seeAll&seleccionar=true">buscar</a><br>
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
    <input type="button" value="CALCULAR" onclick="hacerPresamo()"/>
</form>

<div class="resultadosPrestamo" id="resultadosPrestamo">

</div>