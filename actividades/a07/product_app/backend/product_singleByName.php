<?php
    include_once __DIR__.'/myapi/Products.php';
    $p = New Products();
    $p->singleByName($_GET['name']);
    $p->getData();
?>