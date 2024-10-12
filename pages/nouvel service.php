<?php
    require_once("identifier.php");
?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Nouvel service</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <?php include("menu.php");?>
        
        <div class="container">
            
            <div class="panel panel-primary" style="margin-top: 100px;">
                <div class="panel-heading">Veuillez saisir les données du nouvel service</div>
                <div class="panel-body">
                    <form method="post" action="insertService.php" >
                        <div class="form-group">
                            <label for="noms">Nom du service :</label>
                            <input type="text" name="noms" placeholder="Taper le nom du service" class="form-control">
                        </div>&nbsp &nbsp
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