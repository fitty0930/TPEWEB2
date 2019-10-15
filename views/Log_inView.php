<?php
    require_once('libs/Smarty.class.php');
    require_once('helpers/AuthHelper.php');

    class Log_inView{
        private $smarty;

        public function __construct() {
            $authHelper = new AuthHelper();
            $UsuarioAdm = $authHelper->ObtenerUsuarioAdm();
            $this->smarty = new Smarty();
            $this->smarty->assign('basehref', BASE_URL);
            $this->smarty->assign('UsuarioAdm', $UsuarioAdm);
        }

        public function MostrarLog_in($categorias,$webkey, $error = NULL) { // si el parametro no existe, asigno null
            $this->smarty->assign('titulo', 'Bienvenido');
            $this->smarty->assign('error', $error);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->assign('webkey', $webkey);
            
            $this->smarty->display('templates/log_in.tpl');
        }

        public function MostrarRegistro($categorias,$webkey, $error = NULL) { 
            $this->smarty->assign('titulo', 'Abre una cuenta, es rápido y fácil.');
            $this->smarty->assign('error', $error);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->assign('webkey', $webkey);
            
            $this->smarty->display('templates/registry.tpl'); 
        }
    }