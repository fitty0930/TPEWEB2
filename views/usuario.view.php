<?php
    require_once('libs/Smarty.class.php');
    require_once('helpers/auth.helper.php');

    class UsuarioView {

        private $smarty;
        
        public function __construct(){
            $authHelper = new AuthHelper();
            $usuarioAdm = $authHelper->obtenerUsuarioAdm();
            $this->smarty = new Smarty();
            $this->smarty->assign('basehref', BASE_URL);
            $this->smarty->assign('usuarioAdm', $usuarioAdm);
        }

        public function mostrarProductos($productos, $categorias){
            $this->smarty->assign('titulo', 'Todos los productos');
            $this->smarty->assign('productos', $productos);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->display('templates/MostrarProductos.tpl'); 
        }
        

        public function mostrarProducto($producto , $categorias){ 
            $this->smarty->assign('titulo', $producto->producto);
            $this->smarty->assign('producto', $producto);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->display('templates/MostrarProducto.tpl'); 
        }

        public function mostrarCategorias($categorias){
            $this->smarty->assign('titulo', 'categorias');
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->display("templates/MostrarCategorias.tpl");    
        }

        public function filtradoCategoria($categoria, $categorias, $productoporcategoria){
            $this->smarty->assign('titulo', 'categoria '.$categoria->nombre);
            $this->smarty->assign('categoria', $categoria);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->assign('productoporcategorias', $productoporcategoria);

            $this->smarty->display("templates/MostrarFiltroCategoria.tpl");
        }
        
        public function msjError($MsjError, $categorias) {
            $this->smarty->assign('titulo', 'Dificultades tecnicas');
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->assign('MsjError', $MsjError);
            $this->smarty->display('templates/MostrarError.tpl'); 
        }
        
    }