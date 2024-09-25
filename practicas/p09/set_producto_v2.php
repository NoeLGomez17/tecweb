<?php
$nombre = isset($_POST['nombre_producto']) ? $_POST['nombre_producto'] : '';
$marca  = isset($_POST['marca_producto']) ? $_POST['marca_producto'] : '';
$modelo = isset($_POST['modelo_producto']) ? $_POST['modelo_producto'] : '';
$precio = isset($_POST['precio_producto']) ? $_POST['precio_producto'] : '';
$detalles = isset($_POST['detalles_producto']) ? $_POST['detalles_producto'] : '';
$unidades = isset($_POST['unidades_producto']) ? $_POST['unidades_producto'] : '';
$imagen = isset($_FILES['imagen_producto']['name']) ? $_FILES['imagen_producto']['name'] : '';
$tmp_name = isset($_FILES['imagen_producto']['tmp_name']) ? $_FILES['imagen_producto']['tmp_name'] : '';

$upload_dir = 'img/';  // Carpeta de destino para la imagen


if (empty($nombre) || empty($marca) || empty($modelo) || empty($precio) || empty($unidades) || empty($imagen)) {
    die('<h1>Faltan datos obligatorios del producto</h1>');
}


@$link = new mysqli('localhost', 'root', '123456789', 'marketzone');
if ($link->connect_errno) {
    die('<h1>Falló la conexión a la base de datos: '.$link->connect_error.'</h1>');
}


$sql_check = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND marca = '{$marca}' AND modelo = '{$modelo}'";
$result = $link->query($sql_check);

if ($result && $result->num_rows > 0) {
    // Producto ya existe, mostrar error
    echo "<h1>Error: El producto ya existe en la base de datos</h1>";
    echo "<p>Producto: {$nombre}, Marca: {$marca}, Modelo: {$modelo}</p>";
} else {
    // Mover la imagen al directorio de imágenes
    if (move_uploaded_file($tmp_name, $upload_dir . $imagen)) {
        // Insertar el nuevo producto en la base de datos
        $sql_insert = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                       VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";

        if ($link->query($sql_insert)) {
            // Mostrar resumen del producto insertado
            echo "<h1>Producto insertado con éxito</h1>";
            echo "<p><strong>ID:</strong> ".$link->insert_id."</p>";
            echo "<p><strong>Nombre:</strong> {$nombre}</p>";
            echo "<p><strong>Marca:</strong> {$marca}</p>";
            echo "<p><strong>Modelo:</strong> {$modelo}</p>";
            echo "<p><strong>Precio:</strong> {$precio}</p>";
            echo "<p><strong>Detalles:</strong> {$detalles}</p>";
            echo "<p><strong>Unidades disponibles:</strong> {$unidades}</p>";
            echo "<p><strong>Imagen:</strong> <img src='{$upload_dir}{$imagen}' alt='Imagen del producto' style='width:200px;'></p>";
        } else {
            // Error al insertar
            echo "<h1>Error: No se pudo insertar el producto</h1>";
            echo "<p>Error: ".$link->error."</p>";
        }
    } else {
        echo "<h1>Error al subir la imagen</h1>";
    }
}

$link->close();

?>
