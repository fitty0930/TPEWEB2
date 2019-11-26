<?php   
    include_once('models/imagen.model.php');
    include_once('models/producto.model.php');
    include_once('models/categoria.model.php');
    include_once('views/admin.view.php');
    include_once('views/usuario.view.php');
    include_once('helpers/auth.helper.php');

    class AdminController{
        
        private $modelProducto; 
        private $modelCategoria; 
        private $viewUser; 
        private $viewAdmin;
        private $authHelper;
        private $modelImagen;
        
        public function __construct(){
            $this->authHelper = new AuthHelper();
            $this->modelProducto= new ProductoModel();
            $this->modelCategoria= new CategoriaModel();
            $globalCategorias= $this->modelCategoria->getCategorias();
            $this->viewAdmin= new AdminView($globalCategorias);
            $this->viewUser= new UsuarioView($globalCategorias);
            $this->modelImagen= new ImagenModel();
        }
        
        // PRODUCTOS
        public function mostrarProductos(){
            $productos = $this->modelProducto->getProductos();
            $this->viewUser->mostrarProductos($productos, $categorias);
        }

        public function mostrarProducto($id_producto){ 
            // var_dump($id_producto);
            $producto = $this->modelProducto->getProductosID($id_producto);
            if($producto){
                $this->viewUser->mostrarProducto($producto);}
            else{
                $this->viewUser->msjError('No se encontró su producto '); // por id
            }
        }

        public function agregarProducto(){
            $this->authHelper->isAdmin();


            $id_categoria = $_POST['categoria']; 
            $producto = $_POST['producto'];
            $marca = $_POST['marca'];
            $precio = $_POST['precio'];
            
            // var_dump($id_categoria);
            if ((!empty($producto)) && (!empty($marca)) && (!empty($precio))  && (!empty($id_categoria)) ){
                $id_producto= $this->modelProducto->agregarProducto($id_categoria, $producto, $marca, $precio);
                var_dump($id_producto);
                $this->guardarImagen($id_producto);
                header("Location: productos"); // lo pateo a home
            } else{
            $this->viewUser->msjError('Faltan campos por rellenar'); }
        }


        public function borrarProducto($params = NULL) { 
            $id_producto= $params[':ID'];
            $this->authHelper->isAdmin();
            $this->borrarImagenLocal($id_producto);

            $this->modelProducto->borrarProducto($id_producto);
            header("Location: ../productos"); // tene en cuenta esto
        }

        


        public function editarUnProducto($params = NULL){ // edita 1 producto por su id 
            $id_producto= $params[':ID'];
            $this->authHelper->isAdmin();
            $producto = $this->modelProducto->Get($id_producto); // no tocarlo se usa solo aca
            // var_dump($producto);
            $selector =$this->modelProducto->getProductosID($id_producto);
            if($producto)
                $this->viewAdmin->editarProducto($producto, $selector);
            else
                $this->viewUser->msjError('No se pudo encontrar el ID de su producto');
        }


        public function editarProductoSelec($params = NULL){
            $id_producto= $params[':ID']; // LLEGA id_producto
            $this->authHelper->isAdmin();
            // var_dump($id_producto);
            $id_categoria = $_POST['categoria'];
            $producto = $_POST['producto'];
            $marca = $_POST['marca'];
            $precio = $_POST['precio'];

            if ((!empty($producto)) && (!empty($marca)) && (!empty($precio))  && (!empty($id_categoria))){
                $this->guardarImagen($id_producto); // guardarImagen
                $this->modelProducto->editarProducto($id_producto, $id_categoria, $producto, $marca, $precio);
               header("Location: ../productos/$id_producto");
            } else
            $this->viewUser->msjError("Datos insuficientes");
        }

        // CATEGORIAS
        public function mostrarCategorias(){
            $categorias= $this->modelCategoria->getCategorias();
            $this->viewUser->mostrarCategorias($categorias);
        }

        
        public function agregarCategoria(){ 
            $this->authHelper->isAdmin();
            $nombre= $_POST['nombre']; 
            if(!empty($nombre)){
                $this->modelCategoria->agregarCategoria($nombre);
                header('Location: categorias');
            }
            else
            $this->viewUser->msjError("No se pudo agregar categoria");
        }


        public function borrarCategoria($params = NULL){
            $id_categoria= $params[':ID'];
            $this->authHelper->isAdmin();

            $puedoBorrar=$this->modelProducto->getProductoPorCategoria($id_categoria);
            if($puedoBorrar==[]){
            $this->modelCategoria->borrarCategoria($id_categoria);
            header('Location: ../categorias');}
            else{
            $this->viewUser->msjError('No puede borrar categorias que tengan productos, elimine los productos para poder eliminar la categoria');
            }
        }

        
        public function editarUnaCategoria($params = NULL){
            $id_categoria= $params[':ID'];
            $this->authHelper->isAdmin();

            $categoria = $this->modelCategoria->get($id_categoria);
            
            if($categoria)
            $this->viewAdmin->editarCategoria($categoria);
            else
            $this->viewUser->msjError('No se pudo encontrar el ID de su categoria');
        }


        public function editarCategoriaSelec($params = NULL){
            $id_categoria= $params[':ID'];
            $this->authHelper->isAdmin();
            $nombre= $_POST['nombre'];

            if(!empty($nombre)){
                $this->modelCategoria->editarCategoria($nombre, $id_categoria); 
                header("Location: ../categorias");
            }
            else{
                $this->viewUser->msjError("Por favor  ingrese un nombre");
            }
        }


        // IMAGENES
        private function guardarImagen($id_producto){
            foreach($_FILES["imagenes"]['tmp_name'] as $key => $tmp_name){
    
                // verificar que haya img
                if($_FILES["imagenes"]["name"][$key]) {
                    if($_FILES['imagenes']['type'][$key] == "image/jpg" || $_FILES['imagenes']['type'][$key] == "image/jpeg" 
                    || $_FILES['imagenes']['type'][$key] == "image/png" ) {
                    $filename = $_FILES["imagenes"]["name"][$key]; // nombre original img
                    $source = $_FILES["imagenes"]["tmp_name"][$key]; // nombre temporal img
                    
                    $directorio = 'imagenes/'; // variable con imagenes
                    
                    
                    $dir=opendir($directorio); // mi carpeta de imagenes
                    // MODELIMAGEN
                    $target_path = $this->modelImagen->subirImagen($directorio, $source, $filename);
                    $this->modelImagen->guardarImagen($target_path, $id_producto);
                    closedir($dir); // cierre de carpeta
                    }
                }
            }
        }

        private function borrarImagenLocal($id_producto){
            $imagenes = $this->modelImagen->getImgProducto($id_producto);
            foreach ($imagenes as $imagen) {
                unlink($imagen->ruta);
            }
        }
        
        public function borrarImagen($params = NULL){
            $id_imagen = $params[':ID'];
            $this->authHelper->isAdmin();
            $imagen = $this->modelImagen->getImagen($id_imagen);
            unlink($imagen->ruta);
            $this->modelImagen->borrarIDImagen($id_imagen);
            header("Location: ../productos/".$imagen->id_producto);
        }
        public function borrarImagenesIDProducto($params = NULL){
            $id_producto= $params[':ID'];
            $this->authHelper->isAdmin();
            $this->borrarImagenLocal($id_producto);
            $this->modelImagen->borrarIDProducto($id_producto);
            header("Location: ../productos/".$id_producto);
        }

        
        
    }

