<?php
require_once('libs/Smarty.class.php');
require_once('helpers/auth.helper.php');

    class CtrlcuentasView{
        
        private $smarty;

        
        public function __construct($globalCategorias = NULL){
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
                $administraAlgo = 0;
                $this->smarty = new Smarty();
                $this->smarty->assign('basehref', BASE_URL);
                $this->smarty->assign('nombreUsuario', $nombreUsuario);
                $this->smarty->assign('idUsuario', $idUsuario); 
                $this->smarty->assign('admin', $admin); 
                $this->smarty->assign('administraAlgo',$administraAlgo);
                $this->smarty->assign('categorias',$globalCategorias); 
        }

        public function mostrarUsuarios($usuarios){ 
            $this->smarty->assign('titulo', 'Usuarios');
            $this->smarty->assign('usuarios', $usuarios);
            $this->smarty->display('templates/mostrarCuentas.tpl'); 
        }

        
        public function msjError($MsjError) { // para error
            $this->smarty->assign('titulo', 'Dificultades tecnicas');
            $this->smarty->assign('MsjError', $MsjError);
            $this->smarty->display('templates/mostrarError.tpl'); 
        }
    }