<?php

    class AuthHelper{
        public function __construct(){}
        
        public function Log_in($usuario){ 
            session_start();

            $_SESSION['id_usuario'] = $usuario->id_usuario;
            $_SESSION['usuario'] = $usuario->nombre_usuario;

        }

        public function Log_out(){
            session_start();
            session_destroy();
        }

        public function checkLoggedIn() {
            if (!isset($_SESSION['id_usuario'])) {
                header('Location: ' . LOGIN); 
                die();
            }    
        }

        public function ObtenerUsuarioAdm(){ 
            if(session_status() != PHP_SESSION_ACTIVE)
                session_start();
            if(!isset($_SESSION['id_usuario'])){
                return NULL;
            }
            
            return $_SESSION['usuario'];
        }
    }