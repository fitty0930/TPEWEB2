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
            $this->viewAdmin= new AdminView();
            $this->viewUser= new UsuarioView();
            $this->modelImagen= new ImagenModel();
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
            $this->authHelper->isAdmin();

            $categorias= $this->modelCategoria->getCategorias();

            $id_categoria = $_POST['categoria']; 
            $producto = $_POST['producto'];
            $marca = $_POST['marca'];
            $precio = $_POST['precio'];
            
            // var_dump($id_categoria);
            if ((!empty($producto)) && (!empty($marca)) && (!empty($precio))  && (!empty($id_categoria)) ){
                $this->modelProducto->agregarProducto($id_categoria, $producto, $marca, $precio); 
                $this->guardarImagen($id_producto);
                header("Location: productos"); // lo pateo a home
            } else{
            $this->viewUser->msjError('Faltan campos,esto antes estaba mal ',$categorias); }
        }


        public function borrarProducto($params = NULL) { 
            $id_producto= $params[':ID'];
            $this->authHelper->isAdmin();
            $this->borrarImagenLocal($id_producto);

            $this->modelProducto->borrarProducto($id_producto);
            header("Location: ../productos"); // tene en cuenta esto
        }

        private function borrarImagenLocal($id_producto){
            $imagenes = $this->modelImagen->getImgProducto($id_producto);
            foreach ($imagenes as $imagen) {
                unlink($imagen->ruta);
            }
        }
        // FIJARSE LOS HEADERS
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


        public function editarUnProducto($params = NULL){ // edita 1 producto por su id 
            $id_producto= $params[':ID'];
            $this->authHelper->isAdmin();
            $producto = $this->modelProducto->Get($id_producto); // no tocarlo se usa solo aca
            // var_dump($producto);
            $categorias = $this->modelCategoria->getCategorias();
            $selector =$this->modelProducto->getProductosID($id_producto);
            if($producto)
                $this->viewAdmin->editarProducto($producto, $categorias, $selector);
            else
                $this->viewUser->msjError('No se pudo encontrar el ID de su producto',$categorias);
        }


        public function editarProductoSelec($params = NULL){
            $id_producto= $params[':ID']; // LLEGA id_producto
            $this->authHelper->isAdmin();
            // var_dump($id_producto);
            $id_categoria = $_POST['categoria'];
            $producto = $_POST['producto'];
            $marca = $_POST['marca'];
            $precio = $_POST['precio'];
            $categorias = $this->modelCategoria->getCategorias();

            if ((!empty($producto)) && (!empty($marca)) && (!empty($precio))  && (!empty($id_categoria))){
                $this->guardarImagen($id_producto); // guardarImagen
                $this->modelProducto->editarProducto($id_producto, $id_categoria, $producto, $marca, $precio);
               header("Location: ../productos");
            } else
            $this->viewUser->msjError("Datos insuficientes",$categorias);
        }

        
        // comienza categorias 
        public function agregarCategoria(){ 
            $this->authHelper->isAdmin();
            $nombre= $_POST['nombre']; 
            $categorias = $this->modelCategoria->getCategorias();
            if(!empty($nombre)){
                $this->modelCategoria->agregarCategoria($nombre);
                header('Location: categorias');
            }
            else
            $this->viewUser->msjError("No se pudo agregar categoria",$categorias);
        }


        public function borrarCategoria($params = NULL){
            $id_categoria= $params[':ID'];
            $this->authHelper->isAdmin();

            $categorias = $this->modelCategoria->getCategorias();
            $puedoBorrar=$this->modelProducto->getProductoPorCategoria($id_categoria);
            if($puedoBorrar==[]){
            $this->modelCategoria->borrarCategoria($id_categoria);
            header('Location: ../categorias');}
            else{
            $this->viewUser->msjError('No puede borrar categorias que tengan productos, elimine los productos para poder eliminar la categoria',$categorias);
            }
        }

        
        public function editarUnaCategoria($params = NULL){
            $id_categoria= $params[':ID'];
            $this->authHelper->isAdmin();

            $categoria = $this->modelCategoria->get($id_categoria);
            $categorias = $this->modelCategoria->getCategorias();
            if($categoria)
            $this->viewAdmin->editarCategoria($categoria, $categorias);
            else
            $this->viewUser->msjError('No se pudo encontrar el ID de su categoria',$categorias);
        }


        public function editarCategoriaSelec($params = NULL){
            $id_categoria= $params[':ID'];
            $this->authHelper->isAdmin();
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

        private function guardarImagen($id_producto){
            foreach($_FILES["imagenes"]['tmp_name'] as $key => $tmp_name){
    
                //Validamos que el archivo exista
                if($_FILES["imagenes"]["name"][$key]) {
                    if($_FILES['imagenes']['type'][$key] == "image/jpg" || $_FILES['imagenes']['type'][$key] == "image/jpeg" 
                    || $_FILES['imagenes']['type'][$key] == "image/png" ) {
                    $filename = $_FILES["imagenes"]["name"][$key]; //Obtenemos el nombre original del archivo
                    $source = $_FILES["imagenes"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
                    
                    $directorio = 'imagenes/'; //Declaramos un  variable con la ruta donde guardaremos los archivos
                    
                    
                    $dir=opendir($directorio); //Abrimos el directorio de destino
                    // MODELIMAGEN
                    $target_path = $this->modelImagen->subirImagen($directorio, $source, $filename);
                    $this->modelImagen->guardarImagen($target_path, $id_producto);
                    closedir($dir); //Cerramos el directorio de destino
                    }
                }
            }
        }

        
        
    }

