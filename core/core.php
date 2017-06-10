<?php

date_default_timezone_set('America/Lima');

#Constantes de conexión
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','bdprestamos');

#Constantes de la APP
define('HTML_DIR','html/');
define('APP_TITLE','SISTEMA PRESTAMOS');

#Clases necesarias en  el proyecto
//require('core/models/exceptions/class.BDException.php');
require('core/models/class.Conexion.php');


#funcion con todos los clientes de la bd
require('core/functions/clientes.php');

#funcion con detalles del prestamo calculado
/*include('core/functions/detallePrestamo.php');
$_detallePrestamo = getDetallePrestamo();

*/
$_clientes = clientes();