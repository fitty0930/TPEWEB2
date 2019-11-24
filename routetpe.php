<?php

require_once "controllers/usuario.controller.php";
require_once "controllers/login.controller.php";
require_once "controllers/admin.controller.php";
require_once "controllers/ctrlcuentas.controller.php";
require_once "Router.php";

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
define("LOGIN", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/login');

if (!isset($_GET['action'])){
    $_GET['action'] = '';
}


$r= new Router();

$r->addRoute("home","GET","UsuarioController", "mostrarProductos");
// LOGIN
$r->addRoute("login","GET","LoginController", "mostrarLogin");
$r->addRoute("registry","GET","LoginController", "mostrarRegistro");
$r->addRoute("checkregistry","POST","LoginController", "Registrar");
$r->addRoute("checklogin","POST","LoginController", "verificarUsuario");
$r->addRoute("logout","GET","LoginController", "Logout");

// PRODUCTOS
$r->addRoute("productos","GET","UsuarioController", "mostrarProductos");
$r->addRoute("productos/:ID","GET","UsuarioController", "mostrarProducto"); // individual
$r->addRoute("nuevoproducto","POST","AdminController", "agregarProducto");
$r->addRoute("borrarproducto/:ID","GET","AdminController", "borrarProducto");
$r->addRoute("edicionproducto/:ID","GET","AdminController", "editarUnProducto"); // este muestra plant p edit
$r->addRoute("editarproducto/:ID","POST","AdminController", "editarProductoSelec");

// CATEGORIAS
$r->addRoute("categorias","GET","UsuarioController", "mostrarCategorias");
$r->addRoute("categorias/:ID","GET","UsuarioController", "mostrarCategoria");
$r->addRoute("nuevacategoria","POST","AdminController", "agregarCategoria");
$r->addRoute("borrarcategoria/:ID","GET","AdminController", "borrarCategoria");
$r->addRoute("edicioncategoria/:ID","GET","AdminController", "editarUnaCategoria");
$r->addRoute("editarcategoria/:ID","POST","AdminController", "editarCategoriaSelec");

//CONTROL DE CUENTAS
$r->addRoute("ctrlcuentas","GET","CtrlcuentasController", "mostrarCuentas");
$r->addRoute("borrarcuenta/:ID","GET","CtrlcuentasController", "borrarCuentas");
$r->addRoute("darpermisocuenta/:ID","GET","CtrlcuentasController", "darPermisos");

// IMAGENES
$r->addRoute("borrarImg/:ID","GET","AdminController", "borrarImagen");
$r->addRoute("borrarTodoImg/:ID","GET","AdminController", "borrarImagenesIDProducto");

// CAMBIAR
// $r->addRoute("showRecovery","GET","LoginController", "showRecovery");
// $r->addRoute("send_recovery","POST","LoginController", "sendRecovery");
// $r->addRoute("password_recovery","GET","LoginController", "passwordRecovery");
// $r->addRoute("reset_password","POST","LoginController", "resetPassword");

$r->setDefaultRoute("UsuarioController", "mostrarProductos");

$r->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 

