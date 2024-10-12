<?php
require_once("identifier.php");
$idC = $_GET['idconge'];
require_once('connexiondb.php');

// Récupérer les informations du congé et les noms et prénoms du personnel
$requete = "SELECT c.*, p.nomp, p.prenomp 
            FROM conge c
            JOIN personnel p ON c.idp = p.idp 
            WHERE c.idc = ?";
$resultat = $pdo->prepare($requete);
$resultat->execute([$idC]);
$congeC = $resultat->fetch();

// Récupérer les types de congés distincts à partir de la base de données
$requeteTypes = "SELECT DISTINCT type FROM conge";
$resultatTypes = $pdo->query($requeteTypes);
$types = $resultatTypes->fetchAll(PDO::FETCH_COLUMN);

?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Editer congé</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <?php include("menu.php"); ?>
        
        <div class="container">
            <div class="panel panel-primary" style="margin-top: 100px;">
                <div class="panel-heading">Veuillez saisir les données du congé</div>
                <div class="panel-body">
                    <form method="post" action="updateConge.php">
                        <div class="form-group">
                            <label for="idconge">ID Congé : <?php echo $idC ?></label>
                            <input type="hidden" name="idconge" class="form-control" value="<?php echo $idC ?>"/>
                        </div>
                        <div class="form-group">
                             <label for="nomp" class="control-label">Nom </label>
                             <input type="text" name="nomp" class="form-control" value="<?php echo $congeC['nomp']; ?>" readonly/>
                        </div>
                        <div class="form-group">
                             <label for="prenomp" class="control-label">Prénom </label>
                             <input type="text" name="prenomp" class="form-control" value="<?php echo $congeC['prenomp']; ?>" readonly/>
                        </div>
                        <div class="form-group">
                            <label for="typeconge" class="control-label">Type :</label>
                            <select name="typeconge" id="typeconge" class="form-control">
                                <option value="<?php echo $congeC['type']; ?>" selected><?php echo $congeC['type']; ?></option>
                                <?php foreach ($types as $type): ?>
                                    <?php if ($type != $congeC['type']): ?>
                                        <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="debut_conge">Début du congé :</label>
                            <input type="text" name="debut_conge" class="form-control" value="<?php echo $congeC['debut_conge']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="fin_conge">Fin du congé :</label>
                            <input type="text" name="fin_conge" class="form-control" value="<?php echo $congeC['fin_conge']; ?>"/>
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




