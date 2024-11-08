<?php
//use TECWEB1\MYAPI\Products as Products;
    include_once __DIR__.'/myapi/Products.php';
    $p = New Products('root', '123456789', 'marketzone');
    $p->list();
    echo $p->getData();
?>