<?php
//Para borrar
    include_once __DIR__.'/myapi/Products.php';
    $p = New Products('root', '123456789', 'marketzone');
    $p->delete($_GET['id']);
    echo $p->getData();
?>