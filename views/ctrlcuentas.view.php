<?php
require_once('libs/Smarty.class.php');
require_once('helpers/auth.helper.php');

    class CtrlcuentasView{
        
        private $smarty;

        // MIRA EL CONSTRUCT PLS
        public function __construct(){
                $authHelper = new AuthHelper();
                $session= $authHelper->obtenerUsuarioAdm();
                $nombreUsuario = $session["usuario"]; //userName
                $idUsuario = $session["id_usuario"];
                $admin = $authHelper->obtenerAdminAdm();

                $this->smarty = new Smarty();
                $this->smarty->assign('basehref', BASE_URL);
                $this->smarty->assign('nombreUsuario', $nombreUsuario);
                $this->smarty->assign('idUsuario', $idUsuario); // PARA MI ESTA DE MAS
                $this->smarty->assign('admin', $admin); // PARA MI ESTA DE MAS
        }

        public function mostrarUsuarios($usuarios, $categorias){ // mostrar usuario
            $this->smarty->assign('titulo', 'Usuarios');
            $this->smarty->assign('usuarios', $usuarios);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->display('templates/mostrarCuentas.tpl'); // showUsers
        }

        
        public function msjError($MsjError, $categorias) { // para error
            $this->smarty->assign('titulo', 'Dificultades tecnicas');
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->assign('MsjError', $MsjError);
            $this->smarty->display('templates/mostrarError.tpl'); 
        }
    }