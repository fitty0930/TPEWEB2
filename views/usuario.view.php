<?php
    require_once('libs/Smarty.class.php');
    require_once('helpers/auth.helper.php');

    class UsuarioView {

        private $smarty;
        
        public function __construct(){
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
        }

        public function mostrarProductos($productos, $categorias){
            $this->smarty->assign('titulo', 'Todos los productos');
            $this->smarty->assign('productos', $productos);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->display('templates/mostrarProductos.tpl'); 
        }
        

        public function mostrarProducto($producto , $categorias, $imagenes){ 
            $this->smarty->assign('titulo', $producto->producto);
            $this->smarty->assign('producto', $producto);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->assign('imagenes', $imagenes); // img
            $this->smarty->display('templates/mostrarProducto.tpl'); 
        }

        public function mostrarCategorias($categorias){
            $this->smarty->assign('titulo', 'categorias');
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->display("templates/mostrarCategorias.tpl");    
        }

        public function filtradoCategoria($categoria, $categorias, $productoporcategoria){
            $this->smarty->assign('titulo', 'categoria '.$categoria->nombre);
            $this->smarty->assign('categoria', $categoria);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->assign('productoporcategorias', $productoporcategoria);

            $this->smarty->display("templates/mostrarFiltroCategoria.tpl");
        }
        
        public function msjError($MsjError, $categorias) {
            $this->smarty->assign('titulo', 'Dificultades tecnicas');
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->assign('MsjError', $MsjError);
            $this->smarty->display('templates/mostrarError.tpl'); 
        }

        public function Egg($todasCuentas,$w,$s, $categorias){
            $this->smarty->assign('titulo', '00111111');
            $this->smarty->assign('todasCuentas', $todasCuentas);
            $this->smarty->assign('categorias', $categorias);
            $this->smarty->assign('web', $w);
            $this->smarty->assign("secret",$s);
            $this->smarty->display('templates/eEgg.tpl');
        }
        
    }