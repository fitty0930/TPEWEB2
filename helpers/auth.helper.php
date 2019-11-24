<?php

    class AuthHelper{
        public function __construct(){}
        
        public function Login($usuario){ 
            session_start();

            $_SESSION['id_usuario'] = $usuario->id_usuario;
            $_SESSION['usuario'] = $usuario->nombre_usuario;
            $_SESSION['admin'] = $usuario->admin;

        }

        public function Logout(){
            session_start();
            session_destroy();
        }

        public function checkLoggedIn() {
            if (!isset($_SESSION['id_usuario'])) {
                header('Location: ' . LOGIN); 
                die();
            }    
        }

        public function isAdmin(){
            $this->checkLoggedIn();
            if($_SESSION['admin'] == 0){
                // darle una respuesta negativa
                header('Location:'. HOME); // CATEGORIAS
                die();
            }
        }

        public function obtenerUsuarioAdm(){ 
            if(session_status() != PHP_SESSION_ACTIVE)
                session_start();
            if(!isset($_SESSION['id_usuario'])){
                return NULL;
            }
            
            return $_SESSION; // $_SESSION['usuario']
        }

        public function obtenerAdminAdm(){ // CAMBIE LA LOGICA DE LA FUNCION
            if(session_status() != PHP_SESSION_ACTIVE)
                session_start();
            if(!isset($_SESSION['admin'])){ 
                // aca chequeo por adm 
                // en lugar de por usuario
                return NULL;
            }
            
            return $_SESSION['admin'];
        }
    }