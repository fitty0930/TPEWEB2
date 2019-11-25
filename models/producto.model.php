<?php
    
    class ProductoModel
    {
        private $db;

        function __construct(){
            $this->db=$this->Connect();
        }

        private function Connect(){ // hace la conexion
            return new PDO('mysql:host=localhost;'
            .'dbname=db_tpe; charset=utf8' 
            , 'root', '');// el primer root es el usuario y el segundo (vacio) la contraseña
        }
        
        // function GetProductos(){// trae los productos de la db
            
        //     $sentencia = $this->db->prepare("SELECT * FROM productos ORDER BY id_categoria ASC");
        //     $sentencia -> execute(); // busca en db
        //     return $sentencia->fetchAll(PDO::FETCH_OBJ); // consigo todos los productos, FETCH_ASSOC

        // }

        public function Get($id_producto){
            $sentencia = $this->db->prepare("SELECT * FROM productos WHERE id_producto = ?");
            $sentencia->execute(array($id_producto));
            return $sentencia->fetch(PDO::FETCH_OBJ);
        }

        function agregarProducto($id_categoria, $producto, $marca, $precio){
            
            $sentencia= $this->db->prepare("INSERT INTO productos(id_categoria, producto, marca, precio) VALUES(?,?,?,?)"); // el signo de preg
            // es lo que voy a insertar en la db, se inserta con variables dentro de un array
            
            $sentencia->execute(array($id_categoria, $producto, $marca, $precio));// cantidad de cosas en el array = cant de ?
            return $this->db->lastInsertId(); // Devuelve el ID de la última fila o secuencia insertada
        }
        
        
        
        function borrarProducto($id_producto){
            
            $sentencia = $this->db->prepare("DELETE FROM productos WHERE id_producto=?"); 
            $sentencia->execute([$id_producto]);
        }

        function editarProducto($id_producto, $id_categoria, $producto, $marca, $precio){ // hacer
            
            $sentencia = $this->db->prepare('UPDATE productos SET id_categoria = ?, producto = ?, marca = ?, precio = ? WHERE id_producto = ?'); // cambiar
            $sentencia->execute([$id_categoria, $producto, $marca, $precio, $id_producto]); // el signo de pregunta busca en el array para mas SEGURIDAD
            // Var_dump ($sentencia->errorInfo ());
        }
        

        function getProductos(){ //ProductosJoin
            $sentencia = $this->db->prepare("SELECT * FROM productos JOIN categorias ON productos.id_categoria=categorias.id_categoria");
            $sentencia -> execute(); // busca en db
            return $sentencia->fetchAll(PDO::FETCH_OBJ); 
            // para 1 solo resultado es fetch

        }

        public function getProductosID($id_producto){ //ProductosJoinID 
            // var_dump($id_producto);
            $sentencia = $this->db->prepare('SELECT productos.id_producto, productos.producto, productos.marca, productos.precio, categorias.nombre AS id_categoria FROM productos JOIN categorias ON productos.id_categoria=categorias.id_categoria WHERE productos.id_producto=?');
            $sentencia-> execute([$id_producto]);
            // Var_dump ($sentencia->errorInfo ());
            
            return $sentencia->fetch(PDO::FETCH_OBJ);
        }

        public function getProductoPorCategoria($id_categoria){
            $sentencia= $this->db->prepare('SELECT * FROM productos WHERE id_categoria= ?');
            $sentencia-> execute([$id_categoria]);
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
    }
    

