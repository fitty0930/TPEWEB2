<?php

    class ComentarioModel{

        private $db;

        public function __construct(){
            $this->db=$this->Connect();
            
        }

        private function Connect(){ // hace la conexion
            return new PDO('mysql:host=mysqldb;'
            .'dbname=db_tpe; charset=utf8' 
            , 'root', 'dockerRoshi');// el primer root es el usuario y el segundo (vacio) la contraseña
        }
        // comentarios id_comentario, texto, puntaje, id_producto, id_usuario
        public function Get($id_comentario){
            $sentencia = $this->db->prepare('SELECT * FROM comentarios WHERE id_comentario = ?');
            $sentencia->execute([$id_comentario]);

            return $sentencia->fetch(PDO::FETCH_OBJ);
        }
        public function obtenerComentariosDelProducto($id_producto){
            $sentencia = $this->db->prepare('SELECT comentarios.id_comentario, comentarios.texto, comentarios.puntaje, usuarios.nombre_usuario AS nombre_usuario FROM comentarios JOIN usuarios ON comentarios.id_usuario=usuarios.id_usuario WHERE comentarios.id_producto = ?');
            $sentencia->execute([$id_producto]);

            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }

        public function obtenerComentariosDelProductoPtsMejores($id_producto){
            $sentencia = $this->db->prepare('SELECT comentarios.id_comentario, comentarios.texto, comentarios.puntaje, usuarios.nombre_usuario AS nombre_usuario FROM comentarios JOIN usuarios ON comentarios.id_usuario=usuarios.id_usuario WHERE comentarios.id_producto = ? ORDER BY comentarios.puntaje DESC');
            $sentencia->execute([$id_producto]);

            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }

        public function obtenerComentariosDelProductoPtsPeores($id_producto){
            $sentencia = $this->db->prepare('SELECT comentarios.id_comentario, comentarios.texto, comentarios.puntaje, usuarios.nombre_usuario AS nombre_usuario FROM comentarios JOIN usuarios ON comentarios.id_usuario=usuarios.id_usuario WHERE comentarios.id_producto = ? ORDER BY comentarios.puntaje ASC');
            $sentencia->execute([$id_producto]);

            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        
        public function borrarComentario($id_comentario){
            $sentencia = $this->db->prepare('DELETE FROM comentarios WHERE id_comentario = ?');
            $sentencia->execute([$id_comentario]);
        }
        public function guardarComentario($texto, $puntaje, $id_producto, $id_usuario){ 
            $sentencia = $this->db->prepare('INSERT INTO comentarios(texto, puntaje, id_producto, id_usuario) VALUES(?,?,?,?)');
            $sentencia->execute([$texto, $puntaje, $id_producto, $id_usuario]);
            return $this->db->lastInsertId(); //  Devuelve el ID de la última fila o secuencia insertada
        }
    }