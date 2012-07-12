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
            <form method="post">
                <input type="hidden" name="controller" value="bezoeker" />
                <input type="hidden" name="action" value="login" />
                <div class="labelpersoon">
                    <div>gebruikersnaam</div>
                    <div>wachtwoord</div>
                </div>
                <div class="inputpersoon">
                    <input type="text" name="gebruikersnaam" />
                    <input type="password" name="wachtwoord" />
                    <input id="hidden_text_check" type="text" name="check" />
                    
                </div>
                <input type="submit" value="inloggen" />

            </form>

            %mededeling%  
        </div>
    </div>
</body>