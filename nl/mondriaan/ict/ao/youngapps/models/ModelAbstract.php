<?php
    namespace nl\mondriaan\ict\ao\youngapps\models; 

    abstract class ModelAbstract
    {
        protected $db;
        private $ww;
        private $gn;


        public function __construct()
        {
            $this->gn="root";
            $this->ww="";

            $this->connect();

            if(!isset($_SESSION))
            {
                session_start();
            }  
        }

        private function connect()
        {
            try{
            $dataSourceName = 'mysql:dbname=werkcontacten;host=localhost';     
            $this->db=new \PDO($dataSourceName,$this->gn,$this->ww);
            }
            catch(\Exception $ex){
               throw new \Exception("Er is een probleem met de database");
            }
        }
    }
