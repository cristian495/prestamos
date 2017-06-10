<?php
if($_POST){
    require("core/core.php");
    switch(isset($_GET['mode']) ? $_GET['mode'] : null){
        case 'hacerPrestamo':
            include('core/bin/ajax/goHacerPrestamo.php');
            break;
        default:
            header('location: index.php');
            break;

    }
}else{
    header('location: index.php');
}