<?php
    namespace nl\mondriaan\ict\ao\youngapps\controllers;
    class AdminController extends ControllerAbstract
    {
        protected function toonAction()
        {
            if($this -> model -> isIngelogd())
            {
                $personeel = $this -> model -> getPersoneel();
                $activiteiten = $this -> model -> getActiviteiten();

                $this -> view -> set('personeel',$personeel);
                $this -> view -> set('activiteiten',$activiteiten);

            }
            else
            {
                $this -> forward('toon','bezoeker');
            }
        }
        protected function verwijderPersoonAction()
        {
            if($this -> model -> isIngelogd())
            {
                if($this -> model -> verwijderPersoneel())
                {
                    $this -> forward('toon','admin');    
                }   

            }
            else
            {
                $this -> forward('toon','bezoeker');
            }
        }
        protected function disableAction()
        {
            if($this -> model -> isIngelogd())
            {
                if($this -> model -> disable())
                {
                    $this -> forward('toon','admin');    
                }      
            }
            else
            {
                $this -> forward('toon','bezoeker');
            }
        }
        protected function enableAction()
        {
            if($this -> model -> isIngelogd())
            {
                if($this -> model -> enable())
                {
                    $this -> forward('toon','admin');    
                }      
            }
            else
            {
                $this -> forward('toon','bezoeker');
            }
        }
        protected function resetAction()
        {
            if($this -> model -> isIngelogd())
            {
                if($this -> model -> resetWachtwoord())
                {
                    $this -> forward('toon','admin');    
                }     
            }
            else
            {
                $this -> forward('toon','bezoeker');
            }
        }
        protected function voegToePersoonAction()
        {
            if($this -> model -> isIngelogd())
            {
                $this -> model -> voegToePersoon();

                $this -> forward('toon','admin');    

            }
            else
            {
                $this -> forward('toon','bezoeker');
            }
        } 
        protected function voegToeActiviteitAction()
        {
            if($this -> model -> isIngelogd())
            {
                $this -> model -> voegToeActiviteit();
                $this -> forward('toon','admin');    
                     
            }
            else
            {
                $this -> forward('toon','bezoeker');
            }
        } 
        protected function verwijderActiviteitAction()
        {
            if($this -> model -> isIngelogd())
            {
                if($this -> model -> verwijderActiviteit())
                {
                    $this -> forward('toon','admin');    
                }   

            }
            else
            {
                $this -> forward('toon','bezoeker');
            }
        }
    }
