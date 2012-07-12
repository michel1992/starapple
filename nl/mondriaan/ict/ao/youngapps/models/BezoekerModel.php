<?php
    namespace nl\mondriaan\ict\ao\youngapps\models;
    class BezoekerModel extends ModelAbstract
    {
        public function getPersoneel()
        {
            if(!isset($_REQUEST['zoekActiviteit']) || empty($_REQUEST['zoekActiviteit']))
            {
                $sql = "SELECT * FROM personeelslid WHERE `geblokkeerd` = 'enabled'";      
            }
            else
            {
                $sql = "SELECT * FROM personeelslid LEFT JOIN hobby on personeelslid.`id` = hobby.`p-id` WHERE hobby.`a-id` = :id AND personeelslid.`geblokkeerd` = 'enabled' AND hobby.`zichtbaar` = 'checked'";                                                                                                                                                                                                                                                                                
            }

            $stmt = $this->db->prepare($sql);
            $stmt -> bindParam(':id',$_REQUEST['zoekActiviteit']);  
            $stmt -> execute();
            return $stmt -> fetchAll();  
        }
        public function getPersoon()
        {
            if(is_numeric($_REQUEST['id']))
            {
                $sql ="SELECT * FROM personeelslid WHERE `id` = :id  AND `geblokkeerd` = 'enabled' LIMIT 1";

                $stmt = $this->db->prepare($sql);
                $stmt -> bindParam(':id',$_REQUEST['id']);
                $stmt -> execute();
                       
                return $stmt -> fetch();   
            }
            else
            {
                throw new \Exception("De ingevoerde waarde is niet numeriek");
            }
          
        }
        public function getAlleActiviteiten()
        {
            $sql ='SELECT * FROM activiteit';

            $stmt = $this->db->prepare($sql);
            $stmt -> execute();    
            return $stmt -> fetchAll();      
        }
        public function getActiviteiten()
        {
        if(is_numeric($_REQUEST['id']))
            {
                $sql ='SELECT * FROM hobby LEFT JOIN activiteit on activiteit.`id` = hobby.`a-id` WHERE hobby.`p-id` = :id';

                $stmt = $this->db->prepare($sql);
                $stmt -> bindParam(':id',$_REQUEST['id']);
                $stmt -> execute();      
                return $stmt -> fetchAll(); 
            }
            else
            {
                throw new \Exception("De ingevoerde waarde is niet numeriek");
            }
             
        }
        public function accepteer()
        {
            if(empty($_REQUEST['check']))
            {
                $sql = 'SELECT * FROM `directie` WHERE `gebruikersnaam` = :gebruikersnaam AND `wachtwoord` = :wachtwoord ';
                $stmt = $this->db->prepare($sql);
                $stmt -> bindParam(':gebruikersnaam',$_REQUEST['gebruikersnaam']);
                $stmt -> bindParam(':wachtwoord',sha1($_REQUEST['wachtwoord']));
                $stmt -> execute();
                if($stmt -> rowCount() != 0 )
                {
                    $persoonId =$stmt -> fetch();
                    $_SESSION['persoonId'] = $persoonId['id']; 
                    $_SESSION['rol'] = 'admin'; 
                    return 'admin';
                }
                else
                {
                    $sql = 'SELECT * FROM `personeelslid` WHERE `gebruikersnaam` = :gebruikersnaam AND `wachtwoord` = :wachtwoord ';
                    $stmt = $this->db->prepare($sql);
                    $stmt -> bindParam(':gebruikersnaam',$_REQUEST['gebruikersnaam']);
                    $stmt -> bindParam(':wachtwoord',sha1($_REQUEST['wachtwoord']));
                    $stmt -> execute();

                    if($stmt -> rowCount() != 0 )
                    {
                        $persoonId =$stmt -> fetch();
                        $_SESSION['persoonId'] = $persoonId['id']; 
                        $_SESSION['gebruikersnaam'] = $persoonId['gebruikersnaam'];
                        $_SESSION['rol'] = 'persoon'; 
                        return 'persoon';
                    }
                    else
                    {
                        return false;
                    }
                }
            }
            else
            {
                return false;
            }
        }


}