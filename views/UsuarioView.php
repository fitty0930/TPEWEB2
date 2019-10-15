<?php
    require_once('libs/Smarty.class.php');
    require_once('helpers/AuthHelper.php');

    class UsuarioView {

        private $smarty;
        
        public function __construct(){
            $authHelper = new AuthHelper();
            $UsuarioAdm = $authHelper->ObtenerUsuarioAdm();
            $this->smarty = new Smarty();
            $this->smarty->assign('basehref', BASE_URL);
            $this->smarty->assign('UsuarioAdm', $UsuarioAdm);
        }

        public function MostrarProductos($productos, $categorias){
            $this->smarty->assign('titulo', 'Todos los productos');
            $this->smarty->assign('productos', $productos);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->display('templates/MostrarProductos.tpl'); 
        }
        

        public function MostrarProducto($producto , $categorias){ 
            $this->smarty->assign('titulo', $producto->producto);
            $this->smarty->assign('producto', $producto);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->display('templates/MostrarProducto.tpl'); 
        }

        public function MostrarCategorias($categorias){
            $this->smarty->assign('titulo', 'categorias');
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->display("templates/MostrarCategorias.tpl");    
        }

        public function FiltradoCategoria($categoria, $categorias, $productoporcategoria){
            $this->smarty->assign('titulo', 'categoria '.$categoria->nombre);
            $this->smarty->assign('categoria', $categoria);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->assign('productoporcategorias', $productoporcategoria);

            $this->smarty->display("templates/MostrarFiltroCategoria.tpl");
        }
        
        public function MsjError($MsjError, $categorias) {
            $this->smarty->assign('titulo', 'Dificultades tecnicas');
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->assign('MsjError', $MsjError);
            $this->smarty->display('templates/MostrarError.tpl'); 
        }
        
    }