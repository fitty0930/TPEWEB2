<?php
 
    require_once "./models/producto.model.php";
    require_once "./models/categoria.model.php";
    require_once "./views/usuario.view.php";

    class UsuarioController{
        private $modelProducto; 
        private $modelCategoria; 
        private $view;
        private $modelImagen;  

        public function __construct(){
            $this->modelProducto = new ProductoModel();
            $this->modelCategoria = new CategoriaModel();
            $globalCategorias= $this->modelCategoria->getCategorias();
            $this->modelImagen= new ImagenModel();
            $this->view = new UsuarioView($globalCategorias);
            
        }

        // PRODUCTOS
        public function mostrarProductos(){
            $productos = $this->modelProducto->getProductos();
            $this->view->mostrarProductos($productos);
        }

        
        public function mostrarProducto($params = NULL){ 
            $id_producto = $params[':ID'];
            $producto = $this->modelProducto->getProductosID($id_producto); 
            $imagenes = $this->modelImagen->getImgProducto($id_producto);
            if($producto){
                $this->view->mostrarProducto($producto, $imagenes);} // AGREGA IMAGENES
            else{
                $this->view->msjError("No se encontró su producto"); 
            }
        }
        
        // CATEGORIAS
        public function mostrarCategorias(){
            $categorias= $this->modelCategoria->getCategorias();
            $this->view->mostrarCategorias($categorias);
        }

        public function mostrarCategoria($params = NULL){ 
            $id_categoria = $params[':ID'];
            $categoria= $this->modelCategoria->Get($id_categoria);
            $productoporcategoria= $this->modelProducto->getProductoPorCategoria($id_categoria);
            if($categoria){
                $this->view->filtradoCategoria($categoria, $productoporcategoria);}
            else{
                $this->view->msjError('No existe tal categoria');}
        }

        
        
    }