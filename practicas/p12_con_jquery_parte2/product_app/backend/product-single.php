<?php
    // Incluimos el archivo de conexión a la base de datos
    include_once __DIR__.'/database.php';

    // Inicializamos el arreglo para almacenar los datos
    $data = array(
        'status'  => 'error',
        'message' => 'No se encontró el producto'
    );

    // Verificamos si se ha recibido un ID por GET
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);  // Asegurarse de que el ID sea un entero para evitar inyecciones SQL

        // Realizamos la consulta SQL para buscar el producto por ID
        $sql = "SELECT * FROM productos WHERE id = {$id} AND eliminado = 0";
        if ($result = $conexion->query($sql)) {
            // Comprobamos si la consulta trajo algún resultado
            if ($result->num_rows > 0) {
                $producto = $result->fetch_assoc();

                // Convertimos los valores a UTF-8 y guardamos el producto en el array
                foreach($producto as $key => $value) {
                    $data['producto'][$key] = utf8_encode($value);
                }
                $data['status'] = 'success';
                $data['message'] = 'Producto encontrado';
            } else {
                $data['message'] = 'Producto no encontrado o eliminado';
            }
            $result->free();
        } else {
            $data['message'] = "Error en la consulta: " . mysqli_error($conexion);
        }

        // Cerramos la conexión a la base de datos
        $conexion->close();
    } else {
        $data['message'] = 'No se proporcionó un ID';
    }

    // Convertimos el array $data a JSON y lo imprimimos
    echo json_encode($data, JSON_PRETTY_PRINT);
?>