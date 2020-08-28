
<?php


$controller = 'CLogin';

// Todo esta lógica hara el papel de un FrontController
if (!isset($_REQUEST['controlador'])) {
    include_once "Controlador/$controller.php";
    $controller = ucwords($controller);
    $controller = new $controller;
    $controller->index();
} else {
    // Obtenemos el controlador que queremos cargar
    $controller = strtolower($_REQUEST['controlador']);
    $accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : 'index';

    // Instanciamos el controlador
    require_once "Controlador/$controller.php";
    $controller = ucwords($controller);
    $controller = new $controller;

    // Llama la accion
    call_user_func(array($controller, $accion));
}
