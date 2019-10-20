<?php
 
    require_once "./models/producto.model.php";
    require_once "./models/categoria.model.php";
    require_once "./views/usuario.view.php";

    class UsuarioController{
        private $modelProducto; 
        private $modelCategoria; 
        private $view;  

        public function __construct(){
            $this->modelProducto = new ProductoModel();
            $this->modelCategoria = new CategoriaModel();
            $this->view = new UsuarioView();
        }

        public function mostrarProductos(){
            $productos = $this->modelProducto->getProductos();
            $categorias= $this->modelCategoria->getCategorias();
            $this->view->mostrarProductos($productos, $categorias);
        }

        
        public function mostrarProducto($id_producto){ 
            $producto = $this->modelProducto->getProductosID($id_producto); 
            // var_dump($id_producto);
            // var_dump($producto);
            $categorias = $this->modelCategoria->getCategorias();
            if($producto){
                $this->view->mostrarProducto($producto, $categorias);}
            else{
                $this->view->msjError("No se encontró su producto", $categorias); 
            }
        }
        
        public function mostrarCategorias(){
            $categorias= $this->modelCategoria->getCategorias();
            $this->view->mostrarCategorias($categorias);
            // var_dump($categorias);
        }

        public function mostrarCategoria($id_categoria){ 
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