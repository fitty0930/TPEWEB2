<?php
 
    require_once "./models/ProductoModel.php";
    require_once "./models/CategoriaModel.php";
    require_once "./views/UsuarioView.php";

    class UsuarioController{
        private $modelProducto; 
        private $modelCategoria; 
        private $view;  

        public function __construct(){
            $this->modelProducto = new ProductoModel();
            $this->modelCategoria = new CategoriaModel();
            $this->view = new UsuarioView();
        }

        public function MostrarProductos(){
            $productos = $this->modelProducto->ProductosJoin();
            $categorias= $this->modelCategoria->GetCategorias();
            $this->view->MostrarProductos($productos, $categorias);
        }

        
        public function MostrarProducto($id_producto){ 
            $producto = $this->modelProducto->ProductosJoinID($id_producto); 
            // var_dump($id_producto);
            // var_dump($producto);
            $categorias = $this->modelCategoria->GetCategorias();
            if($producto){
                $this->view->MostrarProducto($producto, $categorias);}
            else{
                $this->view->MsjError("No se encontró su producto", $categorias); 
            }
        }
        
        public function MostrarCategorias(){
            $categorias= $this->modelCategoria->GetCategorias();
            $this->view->MostrarCategorias($categorias);
            // var_dump($categorias);
        }

        public function MostrarCategoria($id_categoria){ 
            $categoria= $this->modelCategoria->Get($id_categoria);
            $categorias= $this->modelCategoria->GetCategorias();
            // aca
            $productoporcategoria= $this->modelProducto->GetProductoPorCategoria($id_categoria);
            // var_dump($productoporcategoria);
            if($categoria){
                $this->view->FiltradoCategoria($categoria, $categorias, $productoporcategoria);}
            else{
                $this->view->MsjError('No existe tal categoria',$categorias);}
        }

        public function MsjError($MsjError){
            $categorias = $this->modelCategoria->GetCategorias();
            $this->view->MsjError($MsjError,$categorias);
        }
        
    }