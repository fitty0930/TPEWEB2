<?php
    require_once('libs/Smarty.class.php');
    require_once('helpers/auth.helper.php');

    class AdminView{

        private $smarty;


        public function __construct(){
            $authHelper = new AuthHelper();
            $this->smarty= new Smarty();
            $usuarioAdm = $authHelper->obtenerUsuarioAdm();
            
            $this->smarty->assign('basehref', BASE_URL);
            $this->smarty->assign('usuarioAdm', $usuarioAdm); // este es el del logueo
        }
        

        public function editarProducto($producto, $categorias, $selector){ 
            // var_dump($producto);
            $this->smarty->assign('titulo', 'Editar '.$producto->producto);
            $this->smarty->assign('producto', $producto);
            $this->smarty->assign('selector', $selector);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->display('templates/EditarProducto.tpl');
        }
        

        public function editarCategoria($categoria, $categorias){ 
            $this->smarty->assign('titulo', 'edit'.$categoria->nombre);
            $this->smarty->assign('categoria', $categoria);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->display('templates/EditarCategoria.tpl');
        }

    }