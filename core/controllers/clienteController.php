<?php

require('core/models/exceptions/class.validationClientException.php');

require('core/models/class.Cliente.php');

$objCliente = new Cliente();
$idValidadp = isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] > 0;

switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
    case 'add':
        if($_POST) {
                //$objCliente->VerificarDatos();
                $objCliente->Add();

        } else {
            include(HTML_DIR . 'cliente/formRegistrarCliente.php');
        }
        break;
    case 'edit':
        if($idValidadp and array_key_exists($_GET['id'],$_clientes)) {
            if($_POST) {
                $objCliente->Edit();
            } else {
                include(HTML_DIR . 'cliente/frmEditarCliente.php');
            }
        } else {
            include(HTML_DIR . 'cliente/frmEditarCliente.php');
        }

        break;
    case 'delete':
        if($idValidadp) {
            $objCliente->Delete();
        } else {
            include(HTML_DIR . 'cliente/todosClientes.php');
        }
        break;
    case 'seeAll':
        if(isset($_GET['seleccionar'])and isset($_GET['from']))
        {
            switch ($_GET['from']){
                case 'hacerPrestamo':
                    $from='hacerPrestamo';
                    break;
                case 'cobrar':
                    $from='cobrar';
                    break;
            }

            $seleccionarCliente = true;


            include(HTML_DIR.'cliente/todosClientes.php');
        }else{
            include(HTML_DIR.'cliente/todosClientes.php');
        }

        break;
    default:
        include(HTML_DIR . 'cliente/indexCliente.php');
        break;
}
