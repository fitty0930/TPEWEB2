<?php
    require_once('libs/Smarty.class.php');
    require_once('helpers/auth.helper.php');

    class AdminView{

        private $smarty;


        public function __construct($globalCategorias = NULL){
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
        

        public function editarProducto($producto, $selector){ 
            // var_dump($producto);
            $this->smarty->assign('titulo', 'Editar '.$producto->producto);
            $this->smarty->assign('producto', $producto);
            $this->smarty->assign('selector', $selector);
            $this->smarty->display('templates/editarProducto.tpl');
        }
        

        public function editarCategoria($categoria){ 
            $this->smarty->assign('titulo', 'edit'.$categoria->nombre);
            $this->smarty->assign('categoria', $categoria);
            $this->smarty->display('templates/editarCategoria.tpl');
        }

    }