<?php
require('core/models/class.Prestamo.php');
$objPrestamo = new Prestamo();

/*
if($_GET['submit'] && $_GET['submit']=1){
    $objPrestamo -> Add();
}*/

switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
    case 'prestamoConfirmado':
        if($_POST){
            $objPrestamo -> Add();
        }else{
            header('location: ?view=hacerPrestamo');
        }

        break;
    default:
        include(HTML_DIR . 'prestamos/realizarPrestamo.php');
        break;
}
