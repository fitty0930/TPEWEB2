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
            $this->modelImagen= new ImagenModel();
            $this->view = new UsuarioView();
            
        }

        // PRODUCTOS
        public function mostrarProductos(){
            $productos = $this->modelProducto->getProductos();
            $categorias= $this->modelCategoria->getCategorias();
            $this->view->mostrarProductos($productos, $categorias);
        }

        
        public function mostrarProducto($params = NULL){ 
            $id_producto = $params[':ID'];
            $producto = $this->modelProducto->getProductosID($id_producto); 
            // var_dump($id_producto);
            // var_dump($producto);
            $imagenes = $this->modelImagen->getImgProducto($id_producto);
            $categorias = $this->modelCategoria->getCategorias();
            if($producto){
                $this->view->mostrarProducto($producto, $categorias, $imagenes);} // AGREGA IMAGENES
            else{
                $this->view->msjError("No se encontró su producto", $categorias); 
            }
        }
        
        // CATEGORIAS
        public function mostrarCategorias(){
            $categorias= $this->modelCategoria->getCategorias();
            $this->view->mostrarCategorias($categorias);
            // var_dump($categorias);
        }

        public function mostrarCategoria($params = NULL){ 
            $id_categoria = $params[':ID'];
            $categoria= $this->modelCategoria->Get($id_categoria);
            $categorias= $this->modelCategoria->getCategorias();
            // aca
            $productoporcategoria= $this->modelProducto->getProductoPorCategoria($id_categoria);
            // var_dump($productoporcategoria);
            if($categoria){
                $this->view->filtradoCategoria($categoria, $categorias, $productoporcategoria);}
            else{
                $this->view->msjError('No existe tal categoria',$categorias);}
        }

        
        
    }