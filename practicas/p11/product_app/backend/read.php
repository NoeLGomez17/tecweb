<?php
    include_once __DIR__.'/database.php';

    $data = array();

    if (isset($_POST['search'])) {
        $search = '%' . $conexion->real_escape_string($_POST['search']) . '%'; // Escapa y añade comodines

        // Consulta que busca coincidencias en nombre, marca o detalles
        $query = "SELECT * FROM productos 
                  WHERE nombre LIKE ? 
                  OR marca LIKE ? 
                  OR detalles LIKE ?";

        if ($stmt = $conexion->prepare($query)) {
            // Bind de los parámetros: tres veces el mismo término de búsqueda
            $stmt->bind_param('sss', $search, $search, $search);
            
            // Ejecuta la consulta
            if ($stmt->execute()) {
                // Obtener el resultado
                $result = $stmt->get_result();

                // Recorrer el resultado
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $producto = array();
                    foreach ($row as $key => $value) {
                        // Codificar a UTF-8 para evitar problemas de caracteres especiales
                        $producto[$key] = utf8_encode($value);
                    }
                    $data[] = $producto; // Añade cada producto al array de datos
                }
                
                $result->free();
            } else {
                // Error en la ejecución
                die('Query Error: ' . $stmt->error);
            }

            // Cerrar el statement
            $stmt->close();
        } else {
            // Error en la preparación de la consulta
            die('Query Error: ' . $conexion->error);
        }
    }

    // Devolver los datos como JSON
    echo json_encode($data, JSON_PRETTY_PRINT);

    // Cerrar la conexión a la base de datos
    $conexion->close();
?>
