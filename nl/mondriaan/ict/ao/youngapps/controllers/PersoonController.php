<?php
    namespace nl\mondriaan\ict\ao\youngapps\controllers;
    class PersoonController extends ControllerAbstract
    {
        protected function toonAction()
        {
            $persoon = $this -> model -> getPersoon();
            $this -> view -> set('persoon',$persoon);

            $activiteiten = $this -> model -> getActiviteiten();
            $this -> view -> set('activiteiten',$activiteiten);

            $hobby = $this -> model->getHobby();
            $this -> view -> set('hobby',$hobby);

        }
        protected function loguitAction()
        {
            $this -> model -> logUit();
            $this -> forward('toon','bezoeker');
        }
        protected function wijzigAction()
        {
            if($this -> model -> isIngelogd())
            {     
                $waarde = $this -> model -> slaWijzigingOp(); 
                $persoon = $this -> model -> getPersoon();
                $this -> view -> set('persoon',$persoon);

                $activiteiten = $this -> model -> getActiviteiten();
                $this -> view -> set('activiteiten',$activiteiten);

                $hobby = $this -> model->getHobby();
                $this -> view -> set('hobby',$hobby);
                $this -> view -> set('fout',$waarde);
                $this -> view -> changeAction('toon');
            }
            else
            {
                $this -> forward('toon','bezoeker');
            }         
        }
    }
