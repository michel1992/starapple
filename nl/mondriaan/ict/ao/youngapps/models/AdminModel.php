<?php
    namespace nl\mondriaan\ict\ao\youngapps\models;
    class AdminModel extends ModelAbstract
    {
        public function isIngelogd()
        {   
            if(!empty($_SESSION['rol']))
                return true;
            else
                return false;    
        }
        public function getActiviteiten()
        {
            $sql ='SELECT * FROM activiteit ORDER BY `ID`';

            $stmt = $this->db->prepare($sql);
            $stmt -> execute();
          
            return $stmt -> fetchAll();      
        }
        public function getPersoneel()
        {
            $sql ='SELECT * FROM personeelslid ORDER BY `ID`';

            $stmt = $this->db->prepare($sql);
            $stmt -> execute();      
            return $stmt -> fetchAll();      
        }
        public function verwijderPersoneel()
        { 
            $sql =' DELETE FROM `personeelslid` WHERE `gebruikersnaam` = :gn LIMIT 1';
            $stmt = $this->db->prepare($sql);
            $stmt -> bindParam(':gn',mysql_real_escape_string($_REQUEST['gn'])); 
            if($stmt -> execute())
            {
                if(file_exists('upload/' . $_REQUEST['gn'] . '.jpg'))
                {
                    unlink('upload/' . $_REQUEST['gn'] . '.jpg');
                }
                return true;
            }   
            else
            {
                return false;
            }
        }
        public function verwijderActiviteit()
        {
            if(is_numeric($_REQUEST['id']))
            {
                $sql =' DELETE FROM `activiteit` WHERE `id` = :id LIMIT 1';
                $stmt = $this->db->prepare($sql);
                $stmt -> bindParam(':id',$_REQUEST['id']);     
                if($stmt -> execute())
                {
                    return true;
                }   
                else
                {
                    return false;
                }
            }
            else
            {
                throw new \Exception("De ingevoerde waarde is niet numeriek");
            }
        }
        public function disable()
        {
        if(is_numeric($_REQUEST['id']))
        {
            $sql ="UPDATE `personeelslid` SET 
            `geblokkeerd` = 'disabled' WHERE `id` = :id ";
            $stmt = $this->db->prepare($sql);

            $stmt -> bindParam(':id',$_REQUEST['id']);     
            if($stmt -> execute())
            {
                return true;
            }   
            else
            {
                return false;
            }
        }
        else
        {
            throw new \Exception("De ingevoerde waarde is niet numeriek");
        }  
        }
        public function enable()
        {
        if(is_numeric($_REQUEST['id']))
        {
            $sql ="UPDATE `personeelslid` SET 
            `geblokkeerd` = 'enabled' WHERE `id` = :id ";
            $stmt = $this->db->prepare($sql);  

            $stmt -> bindParam(':id',$_REQUEST['id']);     
            if($stmt -> execute())
            {
                return true;
            }   
            else
            {
                return false;
            }
                    }
            else
            {
                throw new \Exception("De ingevoerde waarde is niet numeriek");
            } 
        }
        public function resetWachtwoord()
        {
        if(is_numeric($_REQUEST['id']))
        {
            $sql ="UPDATE `personeelslid` SET `wachtwoord` = :wachtwoord WHERE `id` = :id ";
            $stmt = $this->db->prepare($sql);

            $stmt -> bindParam(':id',$_REQUEST['id']);
            $stmt -> bindParam(':wachtwoord',sha1('qwerty'));

            if($stmt -> execute())
            {
                return true;
            }   
            else
            {
                return false;
            }
            }
            else
            {
                throw new \Exception("De ingevoerde waarde is niet numeriek");
            }   
        }
        public function voegToePersoon()
        {
            $sql ="INSERT INTO `personeelslid` (`gebruikersnaam`,`wachtwoord`,`geblokkeerd`, `foto`) VALUES(:gebruikersnaam, :wachtwoord, 'enabled', :foto)";
            $stmt = $this -> db -> prepare($sql);
            $stmt -> bindParam(':gebruikersnaam',mysql_real_escape_string($_REQUEST['gebruikersnaam']));
            $stmt -> bindValue(':wachtwoord',sha1('qwerty'));
            $stmt -> bindValue(':foto','upload/'.mysql_real_escape_string($_REQUEST['gebruikersnaam']) . '.jpg');
            $stmt -> execute() ;


        }
        public function voegToeActiviteit()
        {
            $sql ="INSERT INTO `activiteit` (`naam`) VALUES(:activiteit)";
            $stmt = $this->db->prepare($sql);
            $stmt -> bindParam(':activiteit',mysql_real_escape_string($_REQUEST['activiteit']));
            if($stmt -> execute())
            {
                return true;
            }   
            else
            {
                return false;
            } 

        }
}