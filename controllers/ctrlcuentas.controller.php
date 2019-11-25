<?php
    require_once('helpers/auth.helper.php');
    require_once('models/ctrlcuentas.model.php');
    include_once('models/categoria.model.php');
    require_once('views/ctrlcuentas.view.php');

    class CtrlcuentasController{
        private $authHelper;
        private $modelCtrlcuentas;
        private $modelCategoria;
        private $viewCtrlcuentas;

        public function __construct(){
            $this->authHelper = new AuthHelper();
            $this->modelCtrlcuentas = new CtrlcuentasModel(); 
            $this->modelCategoria = new CategoriaModel(); // categoria
            $this->viewCtrlcuentas= new CtrlcuentasView();
            $this->authHelper->isAdmin(); // MIRARLO
        }

        // CONTROL DE CUENTAS
        public function mostrarCuentas(){ 
            $usuarios= $this->modelCtrlcuentas->getUsuarios();
            $categorias= $this->modelCategoria->getCategorias();
            $this->viewCtrlcuentas->mostrarUsuarios($usuarios, $categorias);
        }

        public function borrarCuentas($params=NULL){
            $id_usuario = $params[':ID'];
            $categorias= $this->modelCategoria->getCategorias();
            $usuario= $this->modelCtrlcuentas->getUsuarioID($id_usuario);
            if($usuario->admin!=0){
                $this->viewCtrlcuentas->msjError('ERROR: Imposible borrar a un admin', $categorias);
                die();
            }
            $this->modelCtrlcuentas->borrarUsuario($id_usuario);
            header("Location: ../ctrlcuentas"); // users
        }

        public function darPermisos($params=NULL){
            $id_usuario= $params[':ID'];
            $categorias= $this->modelCategoria->getCategorias();
            $usuario= $this->modelCtrlcuentas->getUsuarioID($id_usuario);
            if($usuario->admin!=0){
                $this->modelCtrlcuentas->darPermisos(0, $id_usuario);
            }else{
                $this->modelCtrlcuentas->darPermisos(1, $id_usuario);
            }
            header("Location: ../ctrlcuentas");
        }
    }