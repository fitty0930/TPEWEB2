<?php

require_once "controllers/UsuarioController.php";
require_once "controllers/Log_inController.php";
require_once "controllers/AdminController.php";

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
define("LOGIN", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/login');

if (!isset($_GET['action']))
    $_GET['action'] = '';


$action = $_GET['action'];
$partesURL = explode("/", $action);


// decide que acción tomar en base a la url
switch ($partesURL[0]) {
    case 'home':
        $controller = new UsuarioController();
        $controller->MostrarProductos();
    break;

    case 'login':
        $controller = new Log_inController();
        $controller->MostrarLog_in();
    break;

    case 'checklogin':
        $controller = new Log_inController();
        $controller->VerificarUsuario();
    break;

    case 'logout':
        $controller = new Log_inController();
        $controller->Log_out();
    break;

    case 'registry':
        $controller = new Log_inController();
        $controller-> MostrarRegistro();

    break;

    case 'checkregistry':
        $controller= new Log_inController();
        $controller-> Registrar();
    break;
    // productos
    case 'productos':
        $controller = new UsuarioController();
        if (isset($partesURL[1]))
        $controller-> MostrarProducto($partesURL[1]);
        else
        $controller->MostrarProductos();
    break;

    case 'nuevoproducto':
        $controller = new AdminController();
        $controller->AgregarProducto();
    break;

    case 'borrarproducto':
        $controller = new AdminController();
        $controller->BorrarProducto($partesURL[1]);
    break;

    case 'edicionproducto': // ????
        $controller = new AdminController();
        $controller->EditarUnProducto($partesURL[1]);
    break;

    case 'editarproducto':
        $controller = new AdminController();
        $controller->EditarProductoSelec($partesURL[1]);
        // EditarProductoSelec($id_producto)
    break;

    // categorias
    case 'categorias':
        $controller= new UsuarioController();
        if (isset($partesURL[1]))
        $controller-> MostrarCategoria($partesURL[1]);
        else
        $controller-> MostrarCategorias();
    break;

    case 'nuevacategoria':
        $controller= new AdminController();
        $controller-> AgregarCategoria();
    break;
    
    case 'borrarcategoria':
        $controller= new AdminController();
        $controller-> BorrarCategoria($partesURL[1]);
    break;
    
    case 'edicioncategoria':
        $controller= new AdminController();
        $controller->EditarUnaCategoria($partesURL[1]);
    break;
    
    case 'editarcategoria':
        $controller= new AdminController();
        $controller-> EditarCategoriaSelec($partesURL[1]);
    break;    
    

    default:
        $controller = new UsuarioController();
        $controller->MostrarProductos();
    break;
    
}