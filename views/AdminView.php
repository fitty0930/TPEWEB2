<?php
    require_once('libs/Smarty.class.php');
    require_once('helpers/AuthHelper.php');

    class AdminView{

        private $smarty;


        public function __construct(){
            $authHelper = new AuthHelper();
            $this->smarty= new Smarty();
            $UsuarioAdm = $authHelper->ObtenerUsuarioAdm();
            
            $this->smarty->assign('basehref', BASE_URL);
            $this->smarty->assign('UsuarioAdm', $UsuarioAdm); // este es el del logueo
        }
        

        public function EditarProducto($producto, $categorias, $selector){ 
            // var_dump($producto);
            $this->smarty->assign('titulo', 'Editar '.$producto->producto);
            $this->smarty->assign('producto', $producto);
            $this->smarty->assign('selector', $selector);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->display('templates/EditarProducto.tpl');
        }
        

        public function EditarCategoria($categoria, $categorias){ 
            $this->smarty->assign('titulo', 'edit'.$categoria->nombre);
            $this->smarty->assign('categoria', $categoria);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->display('templates/EditarCategoria.tpl');
        }

    }