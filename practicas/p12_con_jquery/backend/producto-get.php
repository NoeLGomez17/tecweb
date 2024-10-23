<?php
    include_once __DIR__.'/database.php';

    $data = array(
        'status'  => 'error',
        'message' => 'No se encontró el producto'
    );

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);  

        $sql = "SELECT * FROM productos WHERE id = {$id} AND eliminado = 0";
        if ($result = $conexion->query($sql)) {
            
            if ($result->num_rows > 0) {
                $producto = $result->fetch_assoc();

                foreach($producto as $key => $value) {
                    $data['producto'][$key] = $value;
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

        
        $conexion->close();
    } else {
        $data['message'] = 'No se proporcionó un ID';
    }

    // Convertimos el array $data a JSON y lo imprimimos
    echo json_encode($data, JSON_PRETTY_PRINT);
?>