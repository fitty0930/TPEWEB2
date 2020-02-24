<?php
    require_once('libs/Smarty.class.php');
    require_once('helpers/auth.helper.php');

    class LoginView{
        private $smarty;

        public function __construct($globalCategorias = NULL) {
            $authHelper = new AuthHelper();
            $session= $authHelper->obtenerUsuarioAdm();
            if($session == NULL ){
                $nombreUsuario = NULL; 
                $idUsuario = NULL;
                $admin = NULL;
            } 
            else{
                $nombreUsuario = $session["usuario"]; 
                $idUsuario = $session["id_usuario"];
                $admin = $authHelper->obtenerAdminAdm();
            }

            $this->smarty = new Smarty();
            $this->smarty->assign('basehref', BASE_URL);
            $this->smarty->assign('nombreUsuario', $nombreUsuario); 
            $this->smarty->assign('idUsuario', $idUsuario); 
            $this->smarty->assign('admin', $admin); 
            $this->smarty->assign('categorias',$globalCategorias);
            
        }

        public function mostrarLogin($webkey, $error = NULL) { 
            $this->smarty->assign('titulo', 'Bienvenido');
            $this->smarty->assign('error', $error);
            $this->smarty->assign('webkey', $webkey);
            
            $this->smarty->display('templates/Login.tpl');
        }

        public function mostrarRegistro($webkey, $error = NULL) { 
            $this->smarty->assign('titulo', 'Abre una cuenta, es rápido y fácil.');
            $this->smarty->assign('error', $error);
            $this->smarty->assign('webkey', $webkey);
            
            $this->smarty->display('templates/Registry.tpl'); 
        }
    }