<?php
switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
    case 'add':
        if($_POST) {
            //$objCliente->VerificarDatos();
            $objCliente->Add();

        } else {
            include(HTML_DIR . 'cliente/formRegistrarCliente.php');
        }
        break;

    default:
        include(HTML_DIR . 'cobros/mainCobro.php');
        break;
}