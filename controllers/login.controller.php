<?php
include_once('views/login.view.php');
include_once('models/usuario.model.php');
include_once('models/categoria.model.php');
include_once('helpers/auth.helper.php');

    class LoginController{
        private $view;
        private $modelUsuario;
        private $modelCategoria; 
        private $authHelper;
        
        public function __construct(){
            $this->view = new LoginView();
            $this->modelUsuario = new UsuarioModel();
            $this->modelCategoria = new CategoriaModel(); 
            $this->authHelper = new AuthHelper();

        }
        public function mostrarLogin(){
            $categorias= $this->modelCategoria->getCategorias();
            $wkeycaptcha = $this->modelUsuario->captchaSecretKey();
            $webkey= $wkeycaptcha->web_key;
            $this->view->mostrarLogin($categorias, $webkey);
        }

        public function verificarUsuario(){
            $categorias= $this->modelCategoria->getCategorias();

            $nombre_usuario = $_POST['usuario'];
            $password = $_POST['password'];
            $captcha = $_POST['g-recaptcha-response'];
            // var_dump($captcha);
            $skeycaptcha = $this->modelUsuario->captchaSecretKey();
            // var_dump($skeycaptcha->secret_key);
            $secret = $skeycaptcha->secret_key;
            $webkey= $skeycaptcha->web_key;
            $usuario = $this->modelUsuario->getUsuario($nombre_usuario); // ESTE FALLA 

            if(!$captcha){           
                $this->view->mostrarLogin($categorias, $webkey, "Completa el captcha");
            }
            else{  
                		
                $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
                  
                $arr = json_decode($response, TRUE);
                    
                if($arr['success']){

                    if (!empty($nombre_usuario) && !empty($password)) {
                        
                        if ($usuario && password_verify($password, $usuario->password)) { // no es isset porque veo el resultado de $usuario 
                            $this->authHelper->Login($usuario);
                            // var_dump($arr);
                            header('Location: productos');
                        } else {
                            $this->view->mostrarLogin($categorias,$webkey, "Usuario o contraseña incorrectos");}
                    } else {
                        $this->view->mostrarLogin($categorias,$webkey, "Quedan campos por rellenar");
                    }
                }else {
                    $this->view->mostrarLogin($categorias,$webkey, "error al verificar captcha");
                }
            }
        }
        
        public function Logout() {
            $this->authHelper->Logout();
            header('Location: home');
        }

        public function mostrarRegistro(){
            $categorias = $this->modelCategoria->getCategorias();
            // model usuario
            $wkeycaptcha = $this->modelUsuario->captchaSecretKey();
            $webkey= $wkeycaptcha->web_key;
            $this->view->mostrarRegistro($categorias, $webkey); // crear el view

        }
        public function Registrar(){
            $categorias = $this->modelCategoria->getCategorias();
            $nombre_usuario = $_POST['usuario'];
            $password = $_POST['password'];
            $captcha = $_POST['g-recaptcha-response'];
            $skeycaptcha = $this->modelUsuario->captchaSecretKey();
            // var_dump($skeycaptcha->secret_key);
            $secret = $skeycaptcha->secret_key;
            $webkey= $skeycaptcha->web_key;
            if(!$captcha){             
                $this->view->mostrarRegistro($categorias,$webkey, "Completa el captcha");
            }
            else{  
                		
                    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
                    
                    $arr = json_decode($response, TRUE);
                    // var_dump($arr);
                    if($arr['success']){
                        if (!empty($nombre_usuario) && !empty($password) && ($nombre_usuario!="administrador")) {

                            $yaesUsuario = $this->modelUsuario->getUsuario($nombre_usuario); // 
        
                            if(!$yaesUsuario){
                                $hash= password_hash($password, PASSWORD_DEFAULT);
                                $this->modelUsuario->Registrar($nombre_usuario, $hash);
                                $usuario= $this->modelUsuario->getUsuario($nombre_usuario);// buscar
        
                                $this->authHelper->Login($usuario);
                                header('Location: productos');
                            }
                            else{
                                
                                $this->view->mostrarRegistro($categorias,$webkey,'Alguien ya registró ese nombre de usuario');
                            }
        
                        }
                        else{
                            $this->view->mostrarRegistro($categorias,$webkey, "Campos vacios o usuario prohibido");
                        }
                    } else {
                        $this->view->mostrarRegistro($categorias,$webkey, "error al verificar captcha");
                    }
                

                
            }
        }
    }
