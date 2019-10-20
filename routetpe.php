<?php

require_once "controllers/usuario.controller.php";
require_once "controllers/login.controller.php";
require_once "controllers/admin.controller.php";

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
        $controller->mostrarProductos();
    break;

    case 'login':
        $controller = new LoginController();
        $controller->mostrarLogin();
    break;

    case 'checklogin':
        $controller = new LoginController();
        $controller->verificarUsuario();
    break;

    case 'logout':
        $controller = new LoginController();
        $controller->Logout();
    break;

    case 'registry':
        $controller = new LoginController();
        $controller-> mostrarRegistro();

    break;

    case 'checkregistry':
        $controller= new LoginController();
        $controller-> Registrar();
    break;
    // productos
    case 'productos':
        $controller = new UsuarioController();
        if (isset($partesURL[1]))
        $controller-> mostrarProducto($partesURL[1]);
        else
        $controller->mostrarProductos();
    break;

    case 'nuevoproducto':
        $controller = new AdminController();
        $controller->agregarProducto();
    break;

    case 'borrarproducto':
        $controller = new AdminController();
        $controller->borrarProducto($partesURL[1]);
    break;

    case 'edicionproducto': // ????
        $controller = new AdminController();
        $controller->editarUnProducto($partesURL[1]);
    break;

    case 'editarproducto':
        $controller = new AdminController();
        $controller->editarProductoSelec($partesURL[1]);
        // EditarProductoSelec($id_producto)
    break;

    // categorias
    case 'categorias':
        $controller= new UsuarioController();
        if (isset($partesURL[1]))
        $controller-> mostrarCategoria($partesURL[1]);
        else
        $controller-> mostrarCategorias();
    break;

    case 'nuevacategoria':
        $controller= new AdminController();
        $controller-> agregarCategoria();
    break;
    
    case 'borrarcategoria':
        $controller= new AdminController();
        $controller-> borrarCategoria($partesURL[1]);
    break;
    
    case 'edicioncategoria':
        $controller= new AdminController();
        $controller->editarUnaCategoria($partesURL[1]);
    break;
    
    case 'editarcategoria':
        $controller= new AdminController();
        $controller-> editarCategoriaSelec($partesURL[1]);
    break;    
    

    default:
        $controller = new UsuarioController();
        $controller->mostrarProductos();
    break;
    
}