<?php
    // hace el login
    class UsuarioModel{
        private $db;

        public function __construct(){
            $this->db=$this->Connect();
            
        }

        private function Connect(){ // hace la conexion
            return new PDO('mysql:host=localhost;'
            .'dbname=db_tpe; charset=utf8' 
            , 'root', '');// el primer root es el usuario y el segundo (vacio) la contraseña
        }

        public function getUsuario($nombre_usuario) { // Get_Usuario
            $sentencia = $this->db->prepare('SELECT * FROM usuarios WHERE nombre_usuario = ?');
            $sentencia->execute(array($nombre_usuario));
    
            return $sentencia->fetch(PDO::FETCH_OBJ);
        }
        
        public function Registrar($nombre_usuario, $password){
            $sentencia = $this->db->prepare('INSERT INTO usuarios(nombre_usuario, password) VALUE(?,?)');
            $sentencia->execute([$nombre_usuario, $password]);
        }

        public function captchaSecretKey(){
            $sentencia = $this->db->prepare('SELECT * FROM gcaptcha');
            $sentencia -> execute();
            // var_dump($sentencia);
            return $sentencia->fetch(PDO::FETCH_OBJ);
        }
    }
