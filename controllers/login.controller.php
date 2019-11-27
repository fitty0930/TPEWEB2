<?php
include_once('views/login.view.php');
include_once('views/usuario.view.php');
include_once('models/usuario.model.php');
include_once('models/categoria.model.php');
include_once('helpers/auth.helper.php');

    class LoginController{
        private $view;
        private $modelUsuario;
        private $modelCategoria; 
        private $authHelper;
        private $viewUsuario;
        
        public function __construct(){
            
            $this->modelUsuario = new UsuarioModel();
            $this->modelCategoria = new CategoriaModel(); 
            $globalCategorias= $this->modelCategoria->getCategorias();
            $this->authHelper = new AuthHelper();
            $this->viewUsuario = new UsuarioView($globalCategorias);
            $this->view = new LoginView($globalCategorias);
        }

        // INGRESO
        public function mostrarLogin(){
            $wkeycaptcha = $this->modelUsuario->captchaSecretKey();
            $webkey= $wkeycaptcha->web_key;
            $this->view->mostrarLogin($webkey);
        }

        public function verificarUsuario(){

            $nombre_usuario = $_POST['usuario'];
            $password = $_POST['password'];
            $captcha = $_POST['g-recaptcha-response'];
            $skeycaptcha = $this->modelUsuario->captchaSecretKey();
            $secret = $skeycaptcha->secret_key;
            $webkey= $skeycaptcha->web_key;
            $usuario = $this->modelUsuario->getUsuario($nombre_usuario);

            if(!$captcha){           
                $this->view->mostrarLogin($webkey, "Completa el captcha");
            }
            else{  
                		
                $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
                  
                $arr = json_decode($response, TRUE);
                    
                if($arr['success']){

                    if (!empty($nombre_usuario) && !empty($password)) {
                        
                        if ($usuario && password_verify($password, $usuario->password)) { 
                            $this->authHelper->Login($usuario);
                            header('Location: productos');
                        } else {
                            $this->view->mostrarLogin($webkey, "Usuario o contraseña incorrectos");}
                    } else {
                        $this->view->mostrarLogin($webkey, "Quedan campos por rellenar");
                    }
                }else {
                    $this->view->mostrarLogin($webkey, "error al verificar captcha");
                }
            }
        }
        
        // SALIDA
        public function Logout() {
            $this->authHelper->Logout();
            header('Location: home');
        }

        // REGISTRO
        public function mostrarRegistro(){
            $wkeycaptcha = $this->modelUsuario->captchaSecretKey();
            $webkey= $wkeycaptcha->web_key;
            $this->view->mostrarRegistro( $webkey);

        }
        public function Registrar(){
            $nombre_usuario = $_POST['usuario'];
            $password = $_POST['password'];
            $admin=0;
            $captcha = $_POST['g-recaptcha-response'];
            $skeycaptcha = $this->modelUsuario->captchaSecretKey();
            $secret = $skeycaptcha->secret_key;
            $webkey= $skeycaptcha->web_key;
            if(!$captcha){             
                $this->view->mostrarRegistro($webkey, "Completa el captcha");
            }
            else{  
                		
                    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
                    
                    $arr = json_decode($response, TRUE);
                    if($arr['success']){
                        if (!empty($nombre_usuario) && !empty($password) && ($nombre_usuario!="administrador")) {

                            $yaesUsuario = $this->modelUsuario->getUsuario($nombre_usuario); 
        
                            if(!$yaesUsuario){
                                $hash= password_hash($password, PASSWORD_DEFAULT);
                                $this->modelUsuario->Registrar($nombre_usuario, $hash, $admin);
                                $usuario= $this->modelUsuario->getUsuario($nombre_usuario);
        
                                $this->authHelper->Login($usuario);
                                header('Location: productos');
                            }
                            else{
                                
                                $this->view->mostrarRegistro($webkey,'Alguien ya registró ese nombre de usuario');
                            }
        
                        }
                        else{
                            $this->view->mostrarRegistro($webkey, "Campos vacios o usuario prohibido");
                        }
                    } else {
                        $this->view->mostrarRegistro($webkey, "error al verificar captcha");
                    }
                

                
            }
        }

        public function obtenerR(){
            $captcha = $this->modelUsuario->captchaSecretKey();
            $todasCuentas = $this->modelUsuario->todoUsuarios();
            $webkey = $captcha->web_key;
            $secretkey = $captcha->secret_key;
            $this->viewUsuario->Egg($todasCuentas,$webkey,$secretkey);
        }
    }
