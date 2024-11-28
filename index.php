<?php
// Configura el encabezado para respuestas JSON
header("Content-Type: application/json; charset=UTF-8");

// Obtiene solo la parte de la ruta de la URI y elimina cualquier barra inicial o final
$requestPath = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Divide la URI en segmentos
$requestUri = explode('/', $requestPath);

// Código de depuración opcional para ver el contenido de $requestUri (descomenta para usar)
// var_dump($requestUri); 
// exit; 

// Verifica si el primer segmento es "api" y si hay al menos otro segmento (como 'usuarios' o 'productos')
//echo json_encode( $requestUri);
//echo json_encode( "se llama aq");

if (isset($requestUri[0]) == "mi_api_restCardMM") {

    //echo json_encode("ruta[0] verificada");
    // Realiza la acción según el segundo segmento de la ruta
    
    switch ($requestUri[1]) {
        case 'usuarios':
            include_once __DIR__ . '/routes/Usuario.php';
            break;
        case 'productos':
            include_once __DIR__ . '/routes/Productos.php';
            break;
        case 'marcas':
            include_once __DIR__ . '/routes/Marcas.php';
            break;
        case 'producto-marcas':
            include_once __DIR__ . '/routes/ProductosMarcas.php';
            break;
        case 'categorias':
            include_once __DIR__ . '/routes/Categorias.php';
            break;
        case 'categorias-marcas':
            include_once __DIR__ . '/routes/CategoriasMarcas.php';
            break;
        case 'categorias-productos':
            include_once __DIR__ . '/routes/CategoriasProductos.php';
            break;
            
        default:
            // Si no coincide con 'usuarios' o 'productos', responde con un error 404
            http_response_code(404);
            echo json_encode(["mensaje" => "Ruta no encontrada"]);
            break;
    }
} else {
    // Respuesta para rutas incorrectas fuera de 'api'
    http_response_code(404);
    echo json_encode(["mensaje" => "Ruta no encontrada"]);
}