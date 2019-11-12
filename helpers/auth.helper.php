<?php

    class AuthHelper{
        public function __construct(){}
        
        public function Login($usuario){ 
            session_start();

            $_SESSION['id_usuario'] = $usuario->id_usuario;
            $_SESSION['usuario'] = $usuario->nombre_usuario;
            $_SESSION['administrador'] = $usuario->admin;

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
            if($_SESSION['administrador'] != 1){
                // darle una respuesta negativa
            }
        }

        public function obtenerUsuarioAdm(){ 
            if(session_status() != PHP_SESSION_ACTIVE)
                session_start();
            if(!isset($_SESSION['id_usuario'])){
                return NULL;
            }
            
            return $_SESSION['usuario'];
        }

        public function obtenerAdminAdm(){
            if(session_status() != PHP_SESSION_ACTIVE)
                session_start();
            if(!isset($_SESSION['id_usuario'])){
                return NULL;
            }
            
            return $_SESSION['administrador'];
        }
    }