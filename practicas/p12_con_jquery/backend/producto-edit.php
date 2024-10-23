<?php
    include_once __DIR__.'/database.php';

 
    $producto = file_get_contents('php://input');
    $data = array(
        'status'  => 'error',
        'message' => 'Error en la actualización del producto'
    );

    if(!empty($producto)) {
    
        $jsonOBJ = json_decode($producto);

        
        if (isset($jsonOBJ->id) && isset($jsonOBJ->nombre) && isset($jsonOBJ->marca) && isset($jsonOBJ->modelo) && isset($jsonOBJ->precio) && isset($jsonOBJ->unidades)) {

           
            $conexion->set_charset("utf8");

            
            $sql = "UPDATE productos SET nombre = '{$jsonOBJ->nombre}', marca = '{$jsonOBJ->marca}', modelo = '{$jsonOBJ->modelo}', precio = {$jsonOBJ->precio}, detalles = '{$jsonOBJ->detalles}', unidades = {$jsonOBJ->unidades}, imagen = '{$jsonOBJ->imagen}' WHERE id = '{$jsonOBJ->id}' AND eliminado = 0";

            
            if ($conexion->query($sql)) {
                $data['status'] = "success";
                $data['message'] = "Producto actualizado correctamente";
            } else {
               
                $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($conexion);
            }
        } else {
            $data['message'] = 'Datos incompletos para la actualización';
        }

        
        $conexion->close();
    } else {
        $data['message'] = 'No se recibió información para actualizar';
    }


    echo json_encode($data, JSON_PRETTY_PRINT);
?>