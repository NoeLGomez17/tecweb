<?php
//Para editar
    //include_once __DIR__.'/myapi/Products.php';
    //$product = New Products();
    //$product->edit(file_get_contents('php://input'));
    //echo $product->getData();

    use TECWEB\MYAPI\Products;
    require_once __DIR__.'/myapi/Products.php';
    $productos = new Products('marketzone');
    $productos->edit( json_decode( json_encode($_POST) ) );
    echo $productos->getData();

    
?>



