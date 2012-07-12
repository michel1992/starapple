<?php
    function __autoload($className)
    {
        $naam='../'.str_replace('\\','/',$className).'.php';
        include_once($naam);    
    }

    if(empty($_REQUEST['action']) || !isset($_REQUEST['action']) || empty($_REQUEST['controller'])|| !isset($_REQUEST['controller']))
    {
        $actionName='toon';
        $controllerName='bezoeker';
    }
    else
    {
        $actionName=$_REQUEST['action']; 
        $controllerName=$_REQUEST['controller'];
    }

    try {
        $controllerName=ucfirst($controllerName);  
        $controller= "nl\\mondriaan\\ict\\ao\\youngapps\\controllers\\{$controllerName}Controller";
        if (class_exists($controller))
        {
            $myController=new $controller($controllerName,$actionName); 
            $myController->execute();
        }
        else
        {
            throw new \Exception("Class not implemented!!!");
        }   
    }
    catch (\Exception $e)
    {
        echo $e->getMessage();   
    }
