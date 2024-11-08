<?php
//Buscar por ID 
    include_once __DIR__.'/myapi/Products.php';
    $p = New Products();
    $p->single($_GET['id']);
    echo $p->getData();
?>