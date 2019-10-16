<?php   
    include_once('models/ProductoModel.php');
    include_once('models/CategoriaModel.php');
    include_once('views/AdminView.php');
    include_once('views/UsuarioView.php');
    include_once('helpers/AuthHelper.php');

    class AdminController{
        
        private $modelProducto; 
        private $modelCategoria; 
        private $view_User; 
        private $view_Admin;
        private $authHelper;

        
        public function __construct(){
            $this->authHelper = new AuthHelper();
            $this->modelProducto= new ProductoModel();
            $this->modelCategoria= new CategoriaModel();
            $this->view_Admin= new AdminView();
            $this->view_User= new UsuarioView();
        }
        

        public function MostrarProductos(){
            $productos = $this->modelProducto->ProductosJoin();
            $categorias= $this->modelCategoria->GetCategorias();
            $this->view_User->MostrarProductos($productos, $categorias);
        }

        public function MostrarProducto($id_producto){ // mostrarproducto_
            // var_dump($id_producto);
            $producto = $this->modelProducto->ProductosJoinID($id_producto);  
            $categorias = $this->modelCategoria->GetCategorias();
            if($producto){
                $this->view_User->MostrarProducto($producto, $categorias);}
            else{
                $this->view_User->MsjError('No se encontró su producto ',$categorias); // por id
            }
        }


        public function MostrarCategorias(){
            $categorias= $this->modelCategoria->GetCategorias();
            $this->view_User->MostrarCategorias($categorias);
        }




        public function AgregarProducto(){
            $this->authHelper->checkLoggedIn();

            $categorias= $this->modelCategoria->GetCategorias();

            $id_categoria = $_POST['categoria']; 
            $producto = $_POST['producto'];
            $marca = $_POST['marca'];
            $precio = $_POST['precio'];
            
            // var_dump($id_categoria);
            if ((!empty($producto)) && (!empty($marca)) && (!empty($precio))  && (!empty($id_categoria)) ){
                $this->modelProducto->AgregarProducto($id_categoria, $producto, $marca, $precio); 
                header("Location: productos"); // lo pateo a home
            } else{
            $this->view_User->MsjError('No se encontró su producto ',$categorias); }
        }


        public function BorrarProducto($id_producto) { 
            
            $this->authHelper->checkLoggedIn();

            $this->modelProducto->BorrarProducto($id_producto);
            header("Location: ../productos"); // tene en cuenta esto
        }


        public function EditarUnProducto($id_producto){ // edita 1 producto por su id 
            
            $this->authHelper->checkLoggedIn();
            $producto = $this->modelProducto->Get($id_producto);
            // var_dump($producto);
            $categorias = $this->modelCategoria->GetCategorias();
            $selector =$this->modelProducto->ProductosJoinID($id_producto);
            if($producto)
                $this->view_Admin->EditarProducto($producto, $categorias, $selector);
            else
                $this->view_User->MsjError('No se pudo encontrar el ID de su producto',$categorias);
        }


        public function EditarProductoSelec($id_producto){
            
            $this->authHelper->checkLoggedIn();
            // var_dump($id_producto);
            $id_categoria = $_POST['categoria'];
            $producto = $_POST['producto'];
            $marca = $_POST['marca'];
            $precio = $_POST['precio'];
            $categorias = $this->modelCategoria->GetCategorias();

            if ((!empty($producto)) && (!empty($marca)) && (!empty($precio))  && (!empty($id_categoria))){
                $this->modelProducto->EditarProducto($id_producto, $id_categoria, $producto, $marca, $precio);
               header("Location: ../productos");
            } else
            $this->view_User->MsjError("Datos insuficientes",$categorias);
        }

        
        // comienza categorias 
        public function AgregarCategoria(){ 
            $this->authHelper->checkLoggedIn();
            $nombre= $_POST['nombre']; 
            $categorias = $this->modelCategoria->GetCategorias();
            if(!empty($nombre)){
                $this->modelCategoria->AgregarCategoria($nombre);
                header('Location: categorias');
            }
            else
            $this->view_User->MsjError("No se pudo agregar categoria",$categorias);
        }


        public function BorrarCategoria($id_categoria){
            
            $this->authHelper->checkLoggedIn();

            $categorias = $this->modelCategoria->GetCategorias();
            $puedoBorrar=$this->modelProducto->GetProductoPorCategoria($id_categoria);
            if($puedoBorrar==[]){
            $this->modelCategoria->BorrarCategoria($id_categoria);
            header('Location: ../categorias');}
            else{
            $this->view_User->MsjError('No puede borrar categorias que tengan productos, elimine los productos para poder eliminar la categoria',$categorias);
            }
        }

        
        public function EditarUnaCategoria($id_categoria){
            
            $this->authHelper->checkLoggedIn();

            $categoria = $this->modelCategoria->Get($id_categoria);
            $categorias = $this->modelCategoria->GetCategorias();
            if($categoria)
            $this->view_Admin->EditarCategoria($categoria, $categorias);
            else
            $this->view_User->MsjError('No se pudo encontrar el ID de su categoria',$categorias);
        }


        public function EditarCategoriaSelec($id_categoria){
            
            $this->authHelper->checkLoggedIn();
            $categorias = $this->modelCategoria->GetCategorias();
            $nombre= $_POST['nombre'];

            if(!empty($nombre)){
                $this->modelCategoria->EditarCategoria($nombre, $id_categoria); 
                header("Location: ../categorias");
            }
            else{
                $this->view_User->MsjError("Por favor  ingrese un nombre",$categorias);
            }
        }

        
        
    }

?>