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
                <a href="?controller=persoon&action=loguit">uitloggen</a>
            </div>
            <div id='content'>
                <h3>Personeelslid Beheer:</h3>
                <div>%personeel%</div>

                <form method="post">
                    <input type="hidden" name="controller" value="admin" />
                    <input type="hidden" name="action" value="voegToePersoon" />
                    <div>gebruikersnaam: 
                        <input name="gebruikersnaam"> 
                        <input value="toevoegen" type="submit">
                    </div>
                </form>


                <h3>Avtiviteit Beheer:</h3>
                <div>%activiteiten%</div>
                <form method="post">
                    <input type="hidden" name="controller" value="admin" />
                    <input type="hidden" name="action" value="voegToeActiviteit" />
                    <div>Nieuw: 
                        <input name="activiteit"> 
                        <input value="toevoegen" type="submit">
                    </div>
                </form>




            </div>
        </div>
    </body>
        </html>