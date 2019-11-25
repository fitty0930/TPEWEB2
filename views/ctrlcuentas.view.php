<?php
require_once('libs/Smarty.class.php');
require_once('helpers/auth.helper.php');

    class CtrlcuentasView{
        
        private $smarty;

        // MIRA EL CONSTRUCT PLS
        public function __construct(){
                $authHelper = new AuthHelper();
                $session= $authHelper->obtenerUsuarioAdm();
                $nombreUsuario = $session["usuario"]; 
                $idUsuario = $session["id_usuario"];
                $admin = $authHelper->obtenerAdminAdm();
                $administraAlgo = 0;
                $this->smarty = new Smarty();
                $this->smarty->assign('basehref', BASE_URL);
                $this->smarty->assign('nombreUsuario', $nombreUsuario);
                $this->smarty->assign('idUsuario', $idUsuario); 
                $this->smarty->assign('admin', $admin); 
                $this->smarty->assign('administraAlgo',$administraAlgo);
        }

        public function mostrarUsuarios($usuarios, $categorias){ 
            $this->smarty->assign('titulo', 'Usuarios');
            $this->smarty->assign('usuarios', $usuarios);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->display('templates/mostrarCuentas.tpl'); 
        }

        
        public function msjError($MsjError, $categorias) { // para error
            $this->smarty->assign('titulo', 'Dificultades tecnicas');
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->assign('MsjError', $MsjError);
            $this->smarty->display('templates/mostrarError.tpl'); 
        }
    }