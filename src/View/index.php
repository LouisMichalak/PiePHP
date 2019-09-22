<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="/PiePHP/webroot/css/style.css">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.2/nouislider.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.2/nouislider.js"></script>
    <script type="text/javascript" src="/PiePHP/webroot/js/script.js"></script>
</head>
<body>
    <header>
        <ul id="dropdown1" class="dropdown-content">
            <?php
            if(empty($_SESSION['user_id'])) {
                echo '<li><a href="/PiePHP/register">Inscription</a></li>'
                    . '<li><a href="/PiePHP/login">Connexion</a></li>';
            } else {
                echo '<li><a href="/PiePHP/user">Profil</a></li>'
                    . '<li><a href="/PiePHP/history">history</a></li>'
                    . '<li><a href="/PiePHP/logout">Déconnexion</a></li>';
            }
            
            ?>
        </ul>
        <nav>
            <div class="nav-wrapper">
                <div class="container">
                    <a href="/PiePHP/" class="brand-logo">My Cinema</a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="/PiePHP/">Accueil</a></li>
                        <li><a href="/PiePHP/film/add">Ajouter un film</a></li>
                        <li>
                            <a class="dropdown-trigger" href="#!" data-target="dropdown1">
                                <?php
                                if(empty($_SESSION['user_id'])) {
                                    echo 'Actions';
                                } else {
                                    echo 'Mon Compte';
                                }
                                ?>
                                <i class="material-icons right">arrow_drop_down</i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
            <?php
            if(empty($_SESSION['user_id'])) {
                echo '<li><a href="/PiePHP/film/add">Ajouter un film</a></li>'
                    . '<li><a href="/PiePHP/register">Inscription</a></li>'
                    . '<li><a href="/PiePHP/login">Connexion</a></li>';
            } else {
                echo '<li><a href="/PiePHP/">Accueil</a></li>'
                    . '<li><a href="/PiePHP/film/add">Ajouter un film</a></li>'
                    . '<li class="divider"></li>'
                    . '<li><a href="/PiePHP/user">Profil</a></li>'
                    . '<li><a href="/PiePHP/history">history</a></li>'
                    . '<li><a href="/PiePHP/logout">Déconnexion</a></li>';
            }
            ?>
        </ul>
    </header>
    <div class="container">
        <?php echo $view; ?>
    </div>
    <footer>

    </footer>
</body>
</html>