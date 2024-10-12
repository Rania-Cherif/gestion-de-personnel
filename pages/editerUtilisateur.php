  <?php
    require_once("identifier.php");
    require_once('connexiondb.php');

    $id=isset($_GET['id'])?$_GET['id']:0;

    $requete="SELECT * FROM utilisateur WHERE iduser=$id";
    $resultat=$pdo->query($requete);
    $utilisateur=$resultat->fetch();

    $login=$utilisateur['login'];
    $email=$utilisateur['email'];
    
     
   ?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Edition d'un utilisateur</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <?php include("menu.php"); ?>
        
        <div class="container">
            <div class="panel panel-primary" style="margin-top: 100px;">
                <div class="panel-heading">Edition de l'utilisateur :</div>
                <div class="panel-body">
                    <form method="post" action="updateUtilisateur.php">
                        
                        <div class="form-group">
                            
                            <input type="hidden" name="iduser" class="form-control" value="<?php echo $id ?>"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="login">Login :</label>
                            <input type="text" name="login" placeholder="login" class="form-control" value="<?php echo $login ?>"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $email ?>"/>
                        </div>
                        
                        <button type="submit" class="btn btn-success">
                           <span class="glyphicon glyphicon-save"></span>
                           Enregistrer
                        </button>
                       
                    </form>
                </div>
            </div>
        </div>
    </body>
</HTML>
