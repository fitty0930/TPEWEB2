<?php
include_once('views/Log_inView.php');
include_once('models/UsuarioModel.php');
include_once('models/CategoriaModel.php');
include_once('helpers/AuthHelper.php');

    class Log_inController{
        private $view;
        private $modelUsuario;
        private $modelCategoria; 
        private $authHelper;
        
        public function __construct(){
            $this->view = new Log_inView();
            $this->modelUsuario = new UsuarioModel();
            $this->modelCategoria = new CategoriaModel(); 
            $this->authHelper = new AuthHelper();

        }
        public function MostrarLog_in(){
            $categorias= $this->modelCategoria->GetCategorias();
            $wkeycaptcha = $this->modelUsuario->CaptchaSecretKey();
            $webkey= $wkeycaptcha->web_key;
            $this->view->MostrarLog_in($categorias, $webkey);
        }

        public function VerificarUsuario(){
            $categorias= $this->modelCategoria->GetCategorias();

            $nombre_usuario = $_POST['usuario'];
            $password = $_POST['password'];
            $captcha = $_POST['g-recaptcha-response'];
            // var_dump($captcha);
            $skeycaptcha = $this->modelUsuario->CaptchaSecretKey();
            // var_dump($skeycaptcha->secret_key);
            $secret = $skeycaptcha->secret_key;
            $webkey= $skeycaptcha->web_key;
            $usuario = $this->modelUsuario->Get_Usuario($nombre_usuario);

            if(!$captcha){           
                $this->view->MostrarLog_in($categorias, $webkey, "Completa el captcha");
            }
            else{  
                		
                $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
                  
                $arr = json_decode($response, TRUE);
                    
                if($arr['success']){

                    if (!empty($nombre_usuario) && !empty($password)) {
                        
                        if (isset($usuario) && password_verify($password, $usuario->password)) {
                            $this->authHelper->Log_in($usuario);
                            // var_dump($arr);
                            header('Location: categorias');
                        } else {
                            $this->view->MostrarLog_in($categorias,$webkey, "Usuario o contraseña incorrectos");}
                    } else {
                        $this->view->MostrarLog_in($categorias,$webkey, "Quedan campos por rellenar");
                    }
                }else {
                    $this->view->MostrarLog_in($categorias,$webkey, "error al verificar captcha");
                }
            }
        }
        
        public function Log_out() {
            $this->authHelper->Log_out();
            header('Location: home');
        }

        public function MostrarRegistro(){
            $categorias = $this->modelCategoria->GetCategorias();
            // model usuario
            $wkeycaptcha = $this->modelUsuario->CaptchaSecretKey();
            $webkey= $wkeycaptcha->web_key;
            $this->view->mostrarRegistro($categorias, $webkey); // crear el view

        }
        public function Registrar(){
            $categorias = $this->modelCategoria->GetCategorias();
            $nombre_usuario = $_POST['usuario'];
            $password = $_POST['password'];
            $captcha = $_POST['g-recaptcha-response'];
            $skeycaptcha = $this->modelUsuario->CaptchaSecretKey();
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

                            $yaesUsuario = $this->modelUsuario->Get_Usuario($nombre_usuario); // 
        
                            if(!$yaesUsuario){
                                $hash= password_hash($password, PASSWORD_DEFAULT);
                                $this->modelUsuario->Registrar($nombre_usuario, $hash);
                                $usuario= $this->modelUsuario->Get_Usuario($nombre_usuario);// buscar
        
                                $this->authHelper->Log_in($usuario);
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
