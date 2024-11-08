<?php
    include_once __DIR__.'/myapi/Products.php';
    $p = New Products();
    $p->search($_GET['search']);
    $p->getData();
?>