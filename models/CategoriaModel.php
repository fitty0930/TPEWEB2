<?php
    class CategoriaModel{
        private $db;

        public function __construct(){
            $this->db = $this->Connect();
            
        }

        private function Connect(){ // hace la conexion
            return new PDO('mysql:host=localhost;'
            .'dbname=db_tpe; charset=utf8' 
            , 'root', '');// el primer root es el usuario y el segundo (vacio) la contraseña
        }

        public function GetCategorias(){
            $sentencia = $this->db->prepare('SELECT * FROM categorias ORDER BY id_categoria ASC');
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        public function Get($id_categoria){
            $sentencia = $this->db->prepare('SELECT * FROM categorias WHERE id_categoria = ?');
            $sentencia->execute(array($id_categoria));
            return $sentencia->fetch(PDO::FETCH_OBJ);
        } 

        public function AgregarCategoria($nombre){
            
            $sentencia= $this->db->prepare("INSERT INTO categorias(nombre) VALUES(?)"); // el signo de preg
            // es lo que voy a insertar en la db, se inserta con variables dentro de un array
            
            $sentencia->execute(array($nombre));// cantidad de cosas en el array = cant de ?
            
        }

        public function BorrarCategoria($id_categoria){
            $sentencia = $this->db->prepare('DELETE FROM categorias WHERE id_categoria = ?');
            $sentencia->execute([$id_categoria]);
        }

        public function EditarCategoria($nombre, $id_categoria){
            $sentencia = $this->db->prepare('UPDATE categorias SET nombre = ? WHERE id_categoria = ?');
            $sentencia->execute([$nombre, $id_categoria]);
        }
    }