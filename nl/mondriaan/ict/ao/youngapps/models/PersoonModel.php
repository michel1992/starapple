<?php
    namespace nl\mondriaan\ict\ao\youngapps\models;
    class PersoonModel extends ModelAbstract
    {
        public function getActiviteiten()
        {
            $sql ='SELECT * FROM activiteit';

            $stmt = $this->db->prepare($sql);
            $stmt -> execute();     
            return $stmt -> fetchAll();      
        }
        public function getPersoon()
        {
            $sql ='SELECT * FROM personeelslid WHERE `id` = :id LIMIT 1';

            $stmt = $this->db->prepare($sql);
            $stmt -> bindParam(':id',$_SESSION['persoonId']);
            $stmt -> execute();

            if($stmt -> rowCount() != 0 )
            {   
                $array = $stmt -> fetch();                               
                $_SESSION['voornaam'] = $array['voornaam'];
                $_SESSION['achternaam'] = $array['achternaam'];
                $_SESSION['telefoon'] = $array['telefoon'];
                $_SESSION['email'] = $array['email'];

                return $array;  
            } 
            else
            {
                return false;    
            }         
        }
        public function isIngelogd()
        {   
            if(!empty($_SESSION['persoonId']))
                return true;
            else
                return false;  
        }
        public function logUit()
        {
            session_destroy();
        } 
        public function slaWijzigingOp()
        {           
            $fout = array();
            if(sha1($_REQUEST['wachtwoord']) === sha1($_REQUEST['wachtwoord2']) && !empty($_REQUEST['wachtwoord']) && !empty($_REQUEST['wachtwoord2']))
            {
                $sql = 'UPDATE `personeelslid` SET `wachtwoord` = :wachtwoord WHERE `id` = :id ';
                $stmt = $this->db->prepare($sql);
                $stmt -> bindParam(':id',$_SESSION['persoonId']);
                $stmt -> bindParam(':wachtwoord',sha1($_REQUEST['wachtwoord2']));
                $stmt -> execute();
            }
            else
            {
                if(!empty($_REQUEST['wachtwoord']) || !empty($_REQUEST['wachtwoord2'])){ 
                    $fout['wachtwoord'] = "class='inputfout'";
                }   
            }
            if(empty($_REQUEST['voornaam'])){ 
                $fout['voornaam'] = "class='inputfout'";

            } 
            if(empty($_REQUEST['achternaam'])){ 
                $fout['achternaam'] = "class='inputfout'";

            } 
            if(empty($_REQUEST['email'])){ 
                $fout['email'] = "class='inputfout'";
            }
            if(!empty($_FILES['foto']['type']) && $_FILES['foto']['type'] != 'image/jpeg'){ 
                $fout['foto'] = "class='inputfout'";
            }  
            if(!empty($fout))
            {
                return $fout; 
            }
            $this -> afbeeldingUpload();

            $sql ='UPDATE `personeelslid` SET 
            `voornaam` = :voornaam , `achternaam` = :achternaam , `email` = :email , `telefoon` = :telefoon WHERE `id` = :id ';
            $stmt = $this->db->prepare($sql);
            $stmt -> bindParam(':id',$_SESSION['persoonId']);
            $stmt -> bindParam(':voornaam',$_REQUEST['voornaam']);
            $stmt -> bindParam(':achternaam',$_REQUEST['achternaam']);
            $stmt -> bindParam(':email',$_REQUEST['email']);
            $stmt -> bindParam(':telefoon',$_REQUEST['telefoon']);

            if($stmt -> execute())
            {   
                foreach($_REQUEST as $index1 => $index2 )
                {  
                    $waarde = explode('_', $index1);

                    if($waarde[0] === 'hobby' )
                    {                           
                        $this -> checkZichtbaar($waarde);
                        if(empty($_SESSION['hobbys']))
                        {
                            if(!isset($_SESSION['hobbys'][$waarde[1]]))
                            {   
                                $_SESSION['hobbys'][$waarde[1]] = $_REQUEST['hobby_' . $waarde[1]];

                                $stmt2 = $this->db->prepare('INSERT INTO hobby (`a-id`,`omschrijving`,`p-id`,`zichtbaar`) VALUES(:activiteit,:omschrijving,:id,:zichtbaar);');
                                $stmt2 -> bindParam(':omschrijving', $_SESSION['hobbys'][$waarde[1]]);
                                $stmt2 -> bindParam(':id',$_SESSION['persoonId']);
                                $stmt2 -> bindParam(':zichtbaar',$_REQUEST['zichtbaar_' . $waarde[1]]);
                                $stmt2 -> bindParam(':activiteit',$waarde[1]);
                                $stmt2 -> execute();                                          
                            }
                        }
                        else
                        {
                            foreach($_SESSION['hobbys'] as $ses1 => $ses2)
                            {         
                                $_SESSION['hobbys'][$ses1] = $_REQUEST['hobby_' . $ses1]; 

                                $stmt2 = $this->db->prepare('UPDATE `hobby` SET `omschrijving` = :omschrijving , `zichtbaar` = :zichtbaar WHERE `p-id` = :id AND `a-id` = :activiteit');
                                $stmt2 -> bindParam(':omschrijving', $_REQUEST['hobby_' . $ses1]);
                                $stmt2 -> bindParam(':id',$_SESSION['persoonId']);
                                $stmt2 -> bindParam(':zichtbaar',$_REQUEST['zichtbaar_' . $ses1]);
                                $stmt2 -> bindParam(':activiteit',$ses1);
                                $stmt2 -> execute();                                       

                                if(!isset($_SESSION['hobbys'][$waarde[1]]) && !empty($_REQUEST['hobby_' . $waarde[1]]))
                                {   
                                    $_SESSION['hobbys'][$waarde[1]] = $_REQUEST['hobby_' . $waarde[1]];

                                    $stmt2 = $this->db->prepare('INSERT INTO hobby (`a-id`,`omschrijving`,`p-id`,`zichtbaar`) VALUES(:activiteit,:omschrijving,:id,:zichtbaar);');
                                    $stmt2 -> bindParam(':omschrijving', $_SESSION['hobbys'][$waarde[1]]);
                                    $stmt2 -> bindParam(':id',$_SESSION['persoonId']);
                                    $stmt2 -> bindParam(':zichtbaar',$_REQUEST['zichtbaar_' . $waarde[1]]);
                                    $stmt2 -> bindParam(':activiteit',$waarde[1]);
                                    $stmt2 -> execute();
                                }     
                            }
                        } 
                    }
                }    
                return $fout;   
            }  
        }
        private function checkZichtbaar($waarde)
        {
            if(!isset($_REQUEST['zichtbaar_' . $waarde[1]]))
            {
                $_REQUEST['zichtbaar_' . $waarde[1]] = '';  
            } 
            else
            {
                $_REQUEST['zichtbaar_' . $waarde[1]] = 'checked';
            } 
        }
        public function getHobby(){
            $sql ='SELECT * FROM hobby WHERE `p-id` = :id ';
            $stmt = $this->db->prepare($sql);
            $stmt -> bindParam(':id',$_SESSION['persoonId']);
            $stmt -> execute();       
            $hobbys = $stmt -> fetchAll();
            foreach($hobbys as $waarde)
            {
                $_SESSION['hobbys'][$waarde['a-id']] = $waarde['omschrijving']; 
                $_SESSION['zichtbaarheid'][$waarde['a-id']] = $waarde['zichtbaar'];   
            }

            return $hobbys;        
        }
        private function afbeeldingUpload()
        {
            if($_FILES['foto']['type'] === 'image/jpeg')
            {
                move_uploaded_file($_FILES['foto']['tmp_name'],'upload/'. $_SESSION['gebruikersnaam']. '.jpg');    
            }
        }

    }
