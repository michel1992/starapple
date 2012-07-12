<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <title>informatiesysteem youngApps</title>
</head>
<body>
    <div id='container'>
        <div id='header'>
            <div id='logo' ></div>
            <div id='headernaam'>YoungApps</div>
        </div>
        <div id='content'>
            <h1>profiel</h1>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="controller" value="persoon" />
                <input type="hidden" name="action" value="wijzig" />
                <input type="hidden" name="gebruikersnaam" value="%gebruikersnaam%" />
                <div>
                    <div class='titelpersoon'>inloggen</div> 
                    <div class='labelpersoon'> 
                        <div>gebruikersnaam</div>               
                        <div>wachtwoord</div>
                        <div>herhaal wachtwoord</div>
                    </div>
                    <div class='inputpersoon'>
                        <input disabled type="text" value="%gebruikersnaam%" /> 
                        <input %inputwachtwoord% type="password" name="wachtwoord" />
                        <input %inputwachtwoord% type="password" name="wachtwoord2" /> 
                    </div>
                </div>
                <div>    
                    <div class='titelpersoon'>naw</div>
                    <div class='labelpersoon'>
                        <div>voornaam(*)</div>
                        <div>achternaam(*)</div>
                        <div>Nieuwe Foto</div>
                        <div>email(*)</div>
                        <div>telefoon</div>
                    </div>
                    <div class='inputpersoon'> 
                        <input %inputvoornaam% type="text" name="voornaam" value="%voornaam%" />
                        <input %inputachternaam% type="text" name="achternaam" value="%achternaam%" />
                        <input %inputfoto% type="file" name="foto"/>
                        <input %inputemail% type="text" name="email" value="%email%" />
                        <input type="text" name="telefoon" value="%telefoon%" />
                    </div> 
                </div>
                <div class='titelpersoon'>activiteiten <div>(*) verplicht</div></div>
                %activiteiten%

                %mededeling%

                <input type="submit" value="aanpassen" />
            </form>

        </div>
        <a href="?controller=persoon&action=loguit">uitloggen</a>
    </div>
</body>