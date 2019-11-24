<?php
    // LISTO
    class CtrlcuentasModel{
        private $db;

        public function __construct(){
            $this->db = $this->Connect();
        }

        private function Connect(){ // hace la conexion
            return new PDO('mysql:host=localhost;'
            .'dbname=db_tpe; charset=utf8' 
            , 'root', '');// el primer root es el usuario y el segundo (vacio) la contraseña
        }

        public function getByUsername($username) { // aun sin modificar
            $query = $this->db->prepare('SELECT * FROM users WHERE username = ?');
            $query->execute(array($username));
    
            return $query->fetch(PDO::FETCH_OBJ);
        }

        public function getUsuarioID($id_usuario) { // va
            $sentencia = $this->db->prepare('SELECT * FROM usuarios WHERE id_usuario = ?');
            $sentencia->execute([$id_usuario]);
    
            return $sentencia->fetch(PDO::FETCH_OBJ);
        }

        // registro aca o en login

        public function getUsuarios(){ // va
            $sentencia = $this->db->prepare('SELECT * FROM usuarios ORDER BY id_usuario ASC');
            $sentencia->execute();

            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }

        public function borrarUsuario($id_usuario){ // va
            $sentencia = $this->db->prepare('DELETE FROM usuarios where id_usuario = ?');
            $sentencia->execute([$id_usuario]);
        }


        public function darPermisos($booleano, $id_usuario){
            $sentencia = $this->db->prepare('UPDATE usuarios SET admin = ? WHERE id_usuario= ?');
            $sentencia->execute([$booleano, $id_usuario]);
        }


        // falta
    }