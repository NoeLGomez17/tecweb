<?php
//Para agregar
    include_once __DIR__.'/myapi/Products.php';
    $p = New Products('root', '123456789', 'marketzone');
    $p->add(file_get_contents('php://input'));
    echo $p->getData();

?>