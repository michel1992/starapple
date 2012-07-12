<?php
    namespace nl\mondriaan\ict\ao\youngapps\views;
    class BezoekerView extends ViewAbstract
    {
        protected function renderToon()
        {
            $tpl = file_get_contents('templates/personeel.tpl');

            $tabel = '';
            foreach ($this->data['personeel'] as $personeel)
            {
                $tabel .= '<a href=?controller=bezoeker&action=detail&id=' . $personeel['id'] . ' >'; 
                $tabel .= "<div class='personeeltabel' >";

                $tabel .= '<div><img src="' . $personeel['foto'] . '" /></div>';
                $tabel .= '<div>' . $personeel['voornaam'] . '</div>';
                $tabel .= '<div>' . $personeel['achternaam'] . '</div>';

                $tabel .= '</div>';
                $tabel .= '</a>';  
            } 

            $tpl = str_replace('%content%',$tabel,$tpl);

            $zoeken = file_get_contents('templates/zoeken.tpl');
            $zoekActiviteiten = '';
            foreach ($this->data['alleActiviteiten'] as $alleActiviteiten)
            {  
                $zoekActiviteiten .= '<option value="' . $alleActiviteiten['id'] . '">' . $alleActiviteiten['naam'] . '</option>';     
            }
            $zoeken = str_replace('%zoekActiviteit%',$zoekActiviteiten,$zoeken);
            $tpl = str_replace('%zoek%',$zoeken,$tpl);

            echo $tpl;  
        }
        protected function renderDetail()
        {
            $tpl = file_get_contents('templates/detail.tpl');       
            $tpl = str_replace('%afbeelding%',$this->data['persoon']['foto'],$tpl);
            $tpl = str_replace('%naam%',$this->data['persoon']['voornaam'] . ' ' . $this->data['persoon']['achternaam'] ,$tpl);       
            $tpl = str_replace('%contact%',$this->data['persoon']['telefoon'],$tpl);
            $tpl = str_replace('%email%',$this->data['persoon']['email'],$tpl);
            $tabel = '';

            foreach ($this->data['activiteiten'] as $activiteiten) 
            {
                if($activiteiten['zichtbaar'] == 'checked')
                {
                    $tabel .= "<div class='titelpersoon'>"; 
                    $tabel .= $activiteiten['naam'];
                    $tabel .= '</div>';
                    $tabel .= "<textarea disabled class='activiteitentext'>" . $activiteiten['omschrijving'] . '</textarea>';
                }
            }              
            $tpl = str_replace('%activiteit%',$tabel,$tpl); 
            echo $tpl;
        }
        protected function renderLogin()
        {
            $tpl = file_get_contents('templates/login.tpl');
            $tpl = str_replace('%mededeling%',$this->data['mededeling'],$tpl);  

            echo $tpl;    
        }
}