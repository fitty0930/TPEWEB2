<?php
require_once("models/comentario.model.php");
require_once("./api/json.view.php");
require_once("models/producto.model.php");
require_once("models/categoria.model.php");
include_once('helpers/auth.helper.php');



class ApiController{
     
    
    private $modelComentario;
    private $modelProducto; 
    private $modelCategoria; 
    private $viewJSON; 
    private $data; 
    private $authHelper;

    public function __construct(){
        $this->modelComentario = new ComentarioModel();
        $this->modelProducto = new ProductoModel();
        $this->viewJSON = new JSONView();
        $this->modelCategoria = new CategoriaModel();
        $this->authHelper = new AuthHelper();
        $this->data = file_get_contents("php://input");
    }
    private function getData() {
        return json_decode($this->data);
    }

    public function obtenerComentariosDelProducto($params = NULL){
        
        $id_producto = $params[':ID'];
        $productoComentarios = $this->modelProducto->Get($id_producto);
        if($productoComentarios){
            $this->modelCategoria->getCategorias();
            $comentarios = $this->modelComentario->obtenerComentariosDelProducto($id_producto);
            $this->viewJSON->response($comentarios, 200);
        }else{
            $this->viewJSON->response('No existe el id del producto', 404);
        }
    } 

    public function agregarComentario(){
        
        $data = $this->getData();
        $comentario = $this->modelComentario->guardarComentario($data->texto , $data->puntaje, $data->id_producto, $data->id_usuario);
        if($comentario){
            $this->viewJSON->response('Su comentario ha sido publicado', 200);
        }else{
            $this->viewJSON->response('No se pudo publicar su comentario', 500);
        }
    }

    public function borrarComentario($params = NULL){
        // $this->authHelper->isAdmin();
        $id_comentario = $params[':ID'];
        $comentario = $this->modelComentario->Get($id_comentario);
        if($comentario){
            $this->modelComentario->borrarComentario($id_comentario);
            $this->viewJSON->response('Comentario borrado con exito', 200);
        }else{
            $this->viewJSON->response("El comentario con el id: $id_comentario no existe", 404);
        }
    }

    public function obtenerComentariosDelProductoPtsMejores($params = NULL){
        
        $id_producto = $params[':ID'];
        $productoComentarios = $this->modelProducto->Get($id_producto);
        if($productoComentarios){
            $this->modelCategoria->getCategorias();
            $comentarios = $this->modelComentario->obtenerComentariosDelProductoPtsMejores($id_producto);
            $this->viewJSON->response($comentarios, 200);
        }else{
            $this->viewJSON->response('No existe el id del producto', 404);
        }
    }

    public function obtenerComentariosDelProductoPtsPeores($params = NULL){
        
        $id_producto = $params[':ID'];
        $productoComentarios = $this->modelProducto->Get($id_producto);
        if($productoComentarios){
            $this->modelCategoria->getCategorias();
            $comentarios = $this->modelComentario->obtenerComentariosDelProductoPtsPeores($id_producto);
            $this->viewJSON->response($comentarios, 200);
        }else{
            $this->viewJSON->response('No existe el id del producto', 404);
        }
    }
}