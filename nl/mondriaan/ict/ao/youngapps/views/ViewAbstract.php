<?php
    namespace nl\mondriaan\ict\ao\youngapps\views;
    abstract class ViewAbstract 
    {
        protected     $data;
        protected     $action;

        public function __construct($action)
        {
            $this->action=$action;
            $this->data=array();
        }

        public function changeAction($action)
        {
            $this->action=$action;
        }

        public function toon()
        {
            $method='render' . ucfirst($this->action);
            if(method_exists($this,$method))
            {
                $this->$method();
            }           
            else
            {
                throw new \Exception("Please implement a function called $method!");
            } 
        } 

        public function  set($key, $value)
        {
            $this->data[$key] = $value;
        }
    }
