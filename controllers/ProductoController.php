<?php

    // este ya no se usa DISCONTINUADO
    // FUERA DE USO
    // FUERA DE USO
    // FUERA DE USO
    
    require_once "./views/ProductoView.php"; 
    require_once "./models/ProductoModel.php"; // se sale con 1 punto no con 2
    require_once "SecuredController.php";

    // para el usuario logueado (cambiar nombre del archivo)
    class ProductoController extends SecuredController {

        private $view;
        private $model;
        private $Titulo;

        function __construct(){
            parent::__construct(); // llamar al padre

            $this->view= new ProductoView(); // this significa llamarse a si mismo, 
            // busca la propiedad view en el mismo objeto
            $this->model= new ProductoModel();
            $this->Titulo= "Productos en venta";
            
        }

        function Home(){
            
            $Productos= $this->model->ProductosJoin(); // GetProductos
            // vista-> mostrar
            $this->view->Mostrar($this->Titulo, $Productos);
            
        }

        function AgregarProducto(){ // inserta en la db
            $categoria= $_POST["categoriaForm"]; // cambiar por contenido de dropdown
            $producto = $_POST["productoForm"];
            $marca = $_POST["marcaForm"];
            $precio = $_POST["precioForm"];
            $this->model->AgregarProducto($categoria, $producto, $marca, $precio);
    
            header('Location: http://'.$_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"])); 
        }    

        function BorrarProducto($param){
            $this->model->BorrarProducto($param[0]);
            header('Location: http://'.$_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]));
        }

        function EditarProducto($param){
            // TBC
            $this->model->EditarProducto($param[0]);
            header('Location: http://'.$_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]));
        }
    }
?>