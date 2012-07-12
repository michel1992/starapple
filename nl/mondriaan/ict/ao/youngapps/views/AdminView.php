<?php
    namespace nl\mondriaan\ict\ao\youngapps\views;
    class AdminView extends ViewAbstract
    {
        protected function renderToon()
        {
            $tpl = file_get_contents('templates/admin.tpl');
            $tabel = '<TABLE border="1">';
            $tabel .= '<tr>';                
            $tabel .= '<td>Nr:</td>';                
            $tabel .= '<td> Status</td>';                
            $tabel .= '<td> Gebruikersnaam</td>';                
            $tabel .= '<td> Voornaam</td>';                
            $tabel .= '<td> Achternaam</td>';                
            $tabel .= '</tr>';

            foreach($this->data['personeel'] as $persoon)
            {
                $tabel .= '<tr>';                
                $tabel .= '<td>' . $persoon['id'] . '</td>';                
                $tabel .= '<td class=' . $persoon['geblokkeerd'] . '>' . $persoon['geblokkeerd'] . '</td>';                
                $tabel .= '<td>' . $persoon['gebruikersnaam'] . '</td>';                
                $tabel .= '<td>' . $persoon['voornaam'] . '</td>';                
                $tabel .= '<td>' . $persoon['achternaam'] . '</td>';
                $tabel .= "<td><a href='?controller=admin&action=verwijderPersoon&gn=". $persoon['gebruikersnaam'] . "'>verwijder</td>";

                if($persoon['geblokkeerd'] === 'disabled')
                    $tabel .= "<td><a href='?controller=admin&action=enable&id=". $persoon['id'] . "'>enable</td>";                                                           
                else
                    $tabel .= "<td><a href='?controller=admin&action=disable&id=". $persoon['id'] . "'>disable</td>";                                                       

                $tabel .= "<td><a href='?controller=admin&action=reset&id=". $persoon['id'] . "'>reset</td>";
                $tabel .= '</tr>';                
            }
            $tabel .= '</TABLE >';
            $tpl = str_replace('%personeel%',$tabel,$tpl);

            $tabel2 = '<TABLE border="1">';
            foreach($this->data['activiteiten'] as $activiteit)
            {
                $tabel2 .= '<tr>';                
                $tabel2 .= '<td>' . $activiteit['id'] . '</td>';                                
                $tabel2 .= '<td>' . $activiteit['naam'] . '</td>';
                $tabel2  .= "<td><a href='?controller=admin&action=verwijderActiviteit&id=". $activiteit['id'] . "'>verwijder</td>";
                $tabel2 .= '</tr>';                
            }
            $tabel2 .= '</TABLE >';        
            $tpl = str_replace('%activiteiten%',$tabel2,$tpl);

            echo $tpl;
        }
}