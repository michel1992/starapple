<?php
    namespace nl\mondriaan\ict\ao\youngapps\controllers;
    abstract class ControllerAbstract
    {
        protected $action;
        protected $controller;
        protected $model;
        protected $view;

        public function __construct($controller,$action)
        {
            $this->action=$action;
			$controller=ucfirst($controller);  
            $this->controller=$controller;
            $modelNaam="nl\\mondriaan\\ict\\ao\\youngapps\\models\\$controller"."Model";
            $this->model=new $modelNaam();
            $viewNaam="nl\\mondriaan\\ict\\ao\\youngapps\\views\\$controller"."View";
            $this->view=new $viewNaam($action);
        }

        public function execute()
        {
            $method=$this->action . 'Action';

            if(method_exists($this,$method))
            {
                $this->$method();
                $this->view->toon();
            }
            else
            {
                throw new \Exception("Please implement a function called $method!");
            }
        }       
        /*
        forward -verandert de afhandeling naar een andere actie en/of controller.
        */
        public function forward($action,$controller = null)
        {
            if($controller === null)
            {
                $this->action=$action;
                $this->view->changeAction($action);
                $this->execute();
            }
            else
            {
                $controllerName=ucfirst($controller);
                $className = "nl\\mondriaan\\ict\\ao\\youngapps\\controllers\\{$controllerName}Controller";
                $myController=new $className($controller,$action); 
                $myController->execute();      
            } 
            exit();
        }   
    }
