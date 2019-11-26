<?php
    require_once('libs/Smarty.class.php');
    require_once('helpers/auth.helper.php');

    class LoginView{
        private $smarty;

        public function __construct($globalCategorias = NULL) {
            $authHelper = new AuthHelper();
            $session= $authHelper->obtenerUsuarioAdm();
            $nombreUsuario = $session["usuario"]; //userName
            $idUsuario = $session["id_usuario"];
            $admin = $authHelper->obtenerAdminAdm();

            $this->smarty = new Smarty();
            $this->smarty->assign('basehref', BASE_URL);
            $this->smarty->assign('nombreUsuario', $nombreUsuario); // $usuarioAdm
            $this->smarty->assign('idUsuario', $idUsuario); // PARA MI ESTA DE MAS
            $this->smarty->assign('admin', $admin); // $adminAdm
            $this->smarty->assign('categorias',$globalCategorias); // categorias
            
        }

        public function mostrarLogin($webkey, $error = NULL) { // si el parametro no existe, asigno null
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