<?php   
    include_once('models/producto.model.php');
    include_once('models/categoria.model.php');
    include_once('views/admin.view.php');
    include_once('views/usuario.view.php');
    include_once('helpers/auth.helper.php');

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
            $this->viewAdmin= new AdminView();
            $this->viewUser= new UsuarioView();
        }
        

        public function mostrarProductos(){
            $productos = $this->modelProducto->getProductos();
            $categorias= $this->modelCategoria->getCategorias();
            $this->viewUser->mostrarProductos($productos, $categorias);
        }

        public function mostrarProducto($id_producto){ // mostrarproducto_
            // var_dump($id_producto);
            $producto = $this->modelProducto->getProductosID($id_producto);  
            $categorias = $this->modelCategoria->getCategorias();
            if($producto){
                $this->viewUser->mostrarProducto($producto, $categorias);}
            else{
                $this->viewUser->msjError('No se encontró su producto ',$categorias); // por id
            }
        }


        public function mostrarCategorias(){
            $categorias= $this->modelCategoria->getCategorias();
            $this->viewUser->mostrarCategorias($categorias);
        }



        // deberias llamar a auth helper y chequear a ver si es admin o no
        public function agregarProducto(){
            $this->authHelper->checkLoggedIn();

            $categorias= $this->modelCategoria->getCategorias();

            $id_categoria = $_POST['categoria']; 
            $producto = $_POST['producto'];
            $marca = $_POST['marca'];
            $precio = $_POST['precio'];
            
            // var_dump($id_categoria);
            if ((!empty($producto)) && (!empty($marca)) && (!empty($precio))  && (!empty($id_categoria)) ){
                $this->modelProducto->agregarProducto($id_categoria, $producto, $marca, $precio); 
                header("Location: productos"); // lo pateo a home
            } else{
            $this->viewUser->msjError('No se encontró su producto ',$categorias); }
        }


        public function borrarProducto($id_producto) { 
            
            $this->authHelper->checkLoggedIn();

            $this->modelProducto->borrarProducto($id_producto);
            header("Location: ../productos"); // tene en cuenta esto
        }


        public function editarUnProducto($id_producto){ // edita 1 producto por su id 
            
            $this->authHelper->checkLoggedIn();
            $producto = $this->modelProducto->Get($id_producto); // no tocarlo se usa solo aca
            // var_dump($producto);
            $categorias = $this->modelCategoria->getCategorias();
            $selector =$this->modelProducto->getProductosID($id_producto);
            if($producto)
                $this->viewAdmin->editarProducto($producto, $categorias, $selector);
            else
                $this->viewUser->msjError('No se pudo encontrar el ID de su producto',$categorias);
        }


        public function editarProductoSelec($id_producto){
            
            $this->authHelper->checkLoggedIn();
            // var_dump($id_producto);
            $id_categoria = $_POST['categoria'];
            $producto = $_POST['producto'];
            $marca = $_POST['marca'];
            $precio = $_POST['precio'];
            $categorias = $this->modelCategoria->getCategorias();

            if ((!empty($producto)) && (!empty($marca)) && (!empty($precio))  && (!empty($id_categoria))){
                $this->modelProducto->editarProducto($id_producto, $id_categoria, $producto, $marca, $precio);
               header("Location: ../productos");
            } else
            $this->viewUser->msjError("Datos insuficientes",$categorias);
        }

        
        // comienza categorias 
        public function agregarCategoria(){ 
            $this->authHelper->checkLoggedIn();
            $nombre= $_POST['nombre']; 
            $categorias = $this->modelCategoria->getCategorias();
            if(!empty($nombre)){
                $this->modelCategoria->agregarCategoria($nombre);
                header('Location: categorias');
            }
            else
            $this->viewUser->msjError("No se pudo agregar categoria",$categorias);
        }


        public function borrarCategoria($id_categoria){
            
            $this->authHelper->checkLoggedIn();

            $categorias = $this->modelCategoria->getCategorias();
            $puedoBorrar=$this->modelProducto->getProductoPorCategoria($id_categoria);
            if($puedoBorrar==[]){
            $this->modelCategoria->borrarCategoria($id_categoria);
            header('Location: ../categorias');}
            else{
            $this->viewUser->msjError('No puede borrar categorias que tengan productos, elimine los productos para poder eliminar la categoria',$categorias);
            }
        }

        
        public function editarUnaCategoria($id_categoria){
            
            $this->authHelper->checkLoggedIn();

            $categoria = $this->modelCategoria->get($id_categoria);
            $categorias = $this->modelCategoria->getCategorias();
            if($categoria)
            $this->viewAdmin->editarCategoria($categoria, $categorias);
            else
            $this->viewUser->msjError('No se pudo encontrar el ID de su categoria',$categorias);
        }


        public function editarCategoriaSelec($id_categoria){
            
            $this->authHelper->checkLoggedIn();
            $categorias = $this->modelCategoria->getCategorias();
            $nombre= $_POST['nombre'];

            if(!empty($nombre)){
                $this->modelCategoria->editarCategoria($nombre, $id_categoria); 
                header("Location: ../categorias");
            }
            else{
                $this->viewUser->msjError("Por favor  ingrese un nombre",$categorias);
            }
        }

        
        
    }

