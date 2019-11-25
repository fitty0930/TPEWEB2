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
            // var_dump($sentencia->fetchAll(PDO::FETCH_OBJ));
            $response = $sentencia->fetch(PDO::FETCH_OBJ);
            return $response;
            //var_dump($sentencia->errorInfo()); die();
            
        }
        
        public function Registrar($nombre_usuario, $password, $admin){ 
            $sentencia = $this->db->prepare('INSERT INTO usuarios(nombre_usuario, password, admin) VALUE(?,?,?)');
            $sentencia->execute([$nombre_usuario, $password, $admin]);
        }

        public function captchaSecretKey(){
            $sentencia = $this->db->prepare('SELECT * FROM gcaptcha');
            $sentencia -> execute();
            // var_dump($sentencia);
            return $sentencia->fetch(PDO::FETCH_OBJ);
        }
    }
