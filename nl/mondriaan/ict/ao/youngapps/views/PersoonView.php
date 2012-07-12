<?php
    namespace nl\mondriaan\ict\ao\youngapps\views;
    class PersoonView extends ViewAbstract
    {
        protected function renderToon()
        {
            $tpl = file_get_contents('templates/persoon.tpl');
            $tpl = str_replace('%gebruikersnaam%',$this->data['persoon']['gebruikersnaam'],$tpl);  
            $tpl = str_replace('%voornaam%',$this->data['persoon']['voornaam'],$tpl);  
            $tpl = str_replace('%achternaam%',$this->data['persoon']['achternaam'],$tpl);  
            $tpl = str_replace('%email%',$this->data['persoon']['email'],$tpl);  
            $tpl = str_replace('%telefoon%',$this->data['persoon']['telefoon'],$tpl);

            if(!empty($this->data['fout'])){  
                foreach($this->data['fout'] as $index1 => $index2)
                {    
                    $tpl = str_replace('%input' . $index1 . '%',$index2,$tpl);
                }
                $tpl = str_replace('%mededeling%','Er zijn gegevens niet of niet goed ingevuld, probeer het opnieuw.',$tpl); 
            }
            else
            {
                $tpl = str_replace('%mededeling%','',$tpl);   
            }
            $tabel = '';
            foreach ($this->data['activiteiten'] as $activiteiten) 
            {
                $tabel .= "<div class='activiteittiteldetail'>"; 
                $tabel .= $activiteiten['naam'];
                $tabel .= '</div>';
                $omschrijving = '';
                $zichtbaar = '';                  
                $a_id = '';
                foreach($this->data['hobby'] as $hobby)
                {   
                    if($hobby['a-id'] == $activiteiten['id'])
                    {
                        $omschrijving = $hobby['omschrijving'];
                        $zichtbaar = $hobby['zichtbaar']; 

                    }

                } 
                $a_id = $activiteiten['id']; 
                $tabel .= "<textarea name='hobby_" . $a_id . "' class='activiteitentextdetail'>" . $omschrijving ."</textarea>";
                $tabel .= "<input type='checkbox' " . $zichtbaar . " name='zichtbaar_" . $a_id . "' >zichtbaar</input>";  
            }


            $tpl = str_replace('%activiteiten%',$tabel,$tpl);

            echo $tpl;  
        }
        protected function renderWijzig()
        {

        }
}