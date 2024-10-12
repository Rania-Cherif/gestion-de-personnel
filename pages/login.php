<?php
    session_start();
    
    require_once('connexiondb.php');
    if (isset($_SESSION['erreurLogin']))
        $erreurLogin=$_SESSION['erreurLogin'];
    else{
        $erreurLogin="";
    }
    session_destroy(); 

?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Se connecter</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        
        <style>
        .imageconnexion {
            position: relative;
            width: 100%;
            height: 640px;
        }
        .imageconnexion::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('../images/imageconnection.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            opacity: 0.7; /* Applique l'opacité uniquement à l'image de fond */
            z-index: 0; /* Assure que l'image est derrière le contenu */
        }
        .container {
            position: relative; 
            z-index: 1;
        }
    </style>
    </head>
    <body>
        <div class="imageconnexion">
            <div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="margin-top: 100px;">
                <div class="panel-heading">Se connecter</div>
                <div class="panel-body">
                    <form method="post" action="seConnecter.php">
                        <?php if(!empty($erreurLogin)) {?>
                            <div class="alert alert-danger">
                                <?php echo $erreurLogin ?>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="login">Login :</label>
                            <input type="text" name="login" placeholder="Login" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Mot de passe :</label>
                            <input type="password" name="pwd" placeholder="Mot de passe" class="form-control">
                        </div>
                        
                        <button type="submit" class="btn btn-success">
                           <span class="glyphicon glyphicon-log-in"></span> Se connecter
                        </button>   
                    </form>
                </div>
            </div>
            </div>
        </div>
    </body>
</HTML>
