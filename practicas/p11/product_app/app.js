// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/imagen.png"
};

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarProducto(e) {
    e.preventDefault();
    
    var searchValue = document.getElementById('search').value; // Obtener valor de búsqueda

    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n' + client.responseText);
            
            // Convierte la respuesta JSON en objeto
            let productos = JSON.parse(client.responseText);
            
            // Limpia el tbody de productos
            let tbody = document.getElementById("productos");
            tbody.innerHTML = '';

            // Recorre la lista de productos y crea filas para la tabla
            productos.forEach(function (producto) {
                let descripcion = `
                    <ul>
                        <li>Precio: ${producto.precio}</li>
                        <li>Unidades: ${producto.unidades}</li>
                        <li>Modelo: ${producto.modelo}</li>
                        <li>Marca: ${producto.marca}</li>
                        <li>Detalles: ${producto.detalles}</li>
                    </ul>`;

                let template = `
                    <tr>
                        <td>${producto.id}</td>
                        <td>${producto.nombre}</td>
                        <td>${descripcion}</td>
                    </tr>`;

                tbody.innerHTML += template; // Agrega el producto a la tabla
            });
        }
    };
    //client.send("search=" + searchValue); // Enviar término de búsqueda
    client.send("search=" + encodeURIComponent(searchValue)); // Envía la búsqueda
}




// FUNCIÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    var nombreProducto = document.getElementById('name').value;

    // Verificar si el nombre está vacío
    if (nombreProducto === "") {
        window.alert("El nombre del producto es obligatorio.");
        return;
    }

    var productoJsonString = document.getElementById('description').value;

    try {
        // Validar si el JSON es válido
        var finalJSON = JSON.parse(productoJsonString);
    } catch (error) {
        window.alert("El formato del JSON es incorrecto.");
        return;
    }

    // Validaciones del JSON (similar a la práctica anterior)
    if (typeof finalJSON.precio !== 'number' || finalJSON.precio <= 0) {
        window.alert("El precio debe ser un número mayor a 0.");
        return;
    }

    if (typeof finalJSON.unidades !== 'number' || finalJSON.unidades <= 0) {
        window.alert("Las unidades deben ser un número mayor a 0.");
        return;
    }

    if (!finalJSON.modelo || finalJSON.modelo === "") {
        window.alert("El modelo del producto es obligatorio.");
        return;
    }

    if (!finalJSON.marca || finalJSON.marca === "") {
        window.alert("La marca del producto es obligatoria.");
        return;
    }

    if (!finalJSON.detalles || finalJSON.detalles === "") {
        window.alert("Los detalles del producto son obligatorios.");
        return;
    }

    if (!finalJSON.imagen || finalJSON.imagen === "") {
        window.alert("La URL de la imagen es obligatoria.");
        return;
    }

    
    finalJSON['nombre'] = nombreProducto;


    productoJsonString = JSON.stringify(finalJSON);

    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            var response = JSON.parse(client.responseText);

            if (response.error) {
                window.alert(response.error);  
            } else if (response.success) {
                window.alert(response.success);  
            }
        }
    };
    client.send(productoJsonString);
}




function getXMLHttpRequest() {
    var objetoAjax;

    try {
        objetoAjax = new XMLHttpRequest();
    } catch (err1) {
        try {
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (err2) {
            try {
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (err3) {
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}


function init() {
    var JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;
}