

<?php
    use TECWEB1\MYAPI\DELETE\Delete;
    include_once __DIR__ . '/vendor/autoload.php';
    $p = New Delete('marketzone');
    $p->delete_dat($_GET['id']);
    echo $p->getData();
?>