<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');

    if (!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JSON A OBJETO
        $jsonOBJ = json_decode($producto);

        // Verificar si el nombre del producto está presente
        if (empty($jsonOBJ->nombre)) {
            echo json_encode(['error' => 'El nombre del producto es obligatorio.']);
            exit;
        }

        // Escapar el nombre del producto para evitar inyecciones SQL
        $nombreProducto = $conexion->real_escape_string($jsonOBJ->nombre);

        // Consulta para verificar si el producto ya existe con el mismo nombre y no está eliminado
        $query = "SELECT * FROM productos WHERE nombre = '$nombreProducto' AND eliminado = 0";
        $result = $conexion->query($query);

        if ($result->num_rows > 0) {
            // Si el producto ya existe, devolvemos un mensaje de error
            echo json_encode(['error' => 'El producto ya existe en la base de datos.']);
            exit;
        }

        // Si el producto no existe, realizar la inserción
        $precio = $jsonOBJ->precio;
        $unidades = $jsonOBJ->unidades;
        $modelo = $jsonOBJ->modelo;
        $marca = $jsonOBJ->marca;
        $detalles = $jsonOBJ->detalles;
        $imagen = $jsonOBJ->imagen;

        // Escapar valores antes de la inserción
        $precio = $conexion->real_escape_string($precio);
        $unidades = $conexion->real_escape_string($unidades);
        $modelo = $conexion->real_escape_string($modelo);
        $marca = $conexion->real_escape_string($marca);
        $detalles = $conexion->real_escape_string($detalles);
        $imagen = $conexion->real_escape_string($imagen);

        // Inserción del producto
        $insertQuery = "INSERT INTO productos (nombre, precio, unidades, modelo, marca, detalles, imagen, eliminado)
                        VALUES ('$nombreProducto', $precio, $unidades, '$modelo', '$marca', '$detalles', '$imagen', 0)";
        
        if ($conexion->query($insertQuery)) {
            echo json_encode(['success' => 'Producto insertado correctamente.']);
        } else {
            echo json_encode(['error' => 'Error al insertar el producto: ' . $conexion->error]);
        }

        $conexion->close();
    } else {
        echo json_encode(['error' => 'No se recibieron datos.']);
    }
?>