<?php
    namespace nl\mondriaan\ict\ao\youngapps\controllers;
    class BezoekerController extends ControllerAbstract
    {
        protected function toonAction()
        {
            $personeel = $this -> model -> getPersoneel();
            $this->view -> set('personeel',$personeel);

            $alleActiviteiten = $this -> model -> getAlleActiviteiten();
            $this -> view -> set('alleActiviteiten',$alleActiviteiten);
        }
        protected function detailAction()
        {
            $persoon = $this->model->getPersoon();
            if($persoon != false)
            {
                $this->view->set('persoon',$persoon);

                $activiteiten = $this->model->getActiviteiten();
                $this->view->set('activiteiten',$activiteiten);
            }
            else
            {
                $this -> forward('toon');
            }  
        } 
        protected function loginAction()
        {
            if(!isset($_SESSION['persoonId']))
            {
                if(!isset($_REQUEST['gebruikersnaam']) || !isset($_REQUEST['wachtwoord']))
                {
                    $this->view->set('mededeling','');    
                }
                else
                {   
                    $controller = $this->model->accepteer();
                    if($controller != false)
                    {
                        $this->forward('toon',$controller);  
                    }
                    else
                    {
                        $this->view->set('mededeling','onbekende gebruikersnaam/wachtwoord combinatie');
                    }
                }
            }
            else
            {
                $this->forward('toon',$_SESSION['rol']); 
            }
        }


    }
