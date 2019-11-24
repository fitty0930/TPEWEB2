<?php
    // creo que esta listo
    class ImagenModel{
        private $db;

        public function __construct(){
            $this->db=$this->Connect();
            
        }

        private function Connect(){ // hace la conexion
            return new PDO('mysql:host=localhost;'
            .'dbname=db_tpe; charset=utf8' 
            , 'root', '');// el primer root es el usuario y el segundo (vacio) la contraseña
        }

        public function guardarImagen($ruta, $id_producto){ // YA
            $sentencia= $this->db->prepare('INSERT INTO imagen (ruta, id_producto) VALUES(?,?)');
            $sentencia->execute([$ruta, $id_producto]);
        }


        public function getImgProducto($id_producto){
            $sentencia = $this->db->prepare('SELECT * FROM imagen WHERE id_producto = ?');
            $sentencia->execute([$id_producto]);
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }

        public function subirImagen($directorio, $source, $filename){ // YA
            $target_path = $directorio. uniqid() . "." . pathinfo($filename, PATHINFO_EXTENSION);
            move_uploaded_file($source, $target_path);
            return $target_path;
        }

        public function borrarIDImagen($id_imagen){
            $sentencia = $this->db->prepare('DELETE FROM imagen WHERE id_imagen = ?');
            $sentencia->execute([$id_imagen]);
        }
        public function borrarIDProducto($id_producto){ 
            $sentencia = $this->db->prepare('DELETE FROM imagen WHERE id_producto = ?');
            $sentencia->execute([$id_producto]);
            // var_dump($sentencia->errorInfo());
        }
        public function getImagen($id_imagen){
            $sentencia = $this->db->prepare('SELECT * FROM imagen WHERE id_imagen = ?');
            $sentencia->execute([$id_imagen]);
            return $sentencia->fetch(PDO::FETCH_OBJ);
        }


    }