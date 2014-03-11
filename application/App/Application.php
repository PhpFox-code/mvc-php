<?php

namespace App;
use Controller;

class Application {

    private $url;
    private $controllerName;
    private $controllerTitle;
    private $action = '';
    private $param = array();

    public function __construct() {
        $this->url = rtrim(filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL), "/");
        if( isset($this->url ) && filter_var($this->url)){
            if($this->explodeUrl()){
                
                if(class_exists( $this->controllerName )){
                    //echo $this->action;
                    //echo '<br>' . 'Controller\\' . MAIN_CONTROLLER . 'Controller';
                    $this->controller = new $this->controllerName($this->controllerTitle, $this->action);
                    if(method_exists($this->controller, $this->action)){
                        
                        call_user_func_array(array($this->controller, $this->action), $this->param);
                        
                    }
                    else if(method_exists($this->controller, 'index')){
                        $this->controller->index();
                    }
                    else{
                        echo "error";
                    }
                }
            }
            
        }else{
            $this->controllerTitle = MAIN_CONTROLLER;
            $this->controllerName = 'Controller\\' . MAIN_CONTROLLER . 'Controller';
            $this->controller = new $this->controllerName($this->controllerTitle, 'index');
            $this->controller->index();
        }
    }
    
    private function explodeUrl(){
        if(isset($this->url)){
            $components = explode('/', $this->url);
            $count = 0;
            foreach($components as $component){
                if($count == 0){
                    $this->controllerTitle = $component;
                    $this->controllerName = 'Controller\\' . $component . 'Controller';
                }
                else if($count == 1){
                    $this->action = $component;
                }
                else{
                    
                    $this->param[] = $component;
                    
                }
                $count++;
            }
            return true;
        }
        else{
            return false;
        }
    }

}
