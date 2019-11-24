<?php
require_once('Router.php');
require_once('./api/comentarios.api.controller.php');

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
define("LOGIN", BASE_URL . 'login');
define("CATEGORIAS", BASE_URL . 'categorias');

$r = new Router();

$r->addRoute("productos/:ID/comentarios", "GET", "ApiController", "obtenerComentariosDelProducto");
$r->addRoute("comentario", "POST", "ApiController", "agregarComentario");
$r->addRoute("comentario/:ID", "DELETE", "ApiController", "borrarComentario");

$r->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);