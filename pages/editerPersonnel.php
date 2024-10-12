<?php
    require_once("identifier.php");
    $Matricule = $_GET['matricule'];
    require_once('connexiondb.php');

    $requete = "SELECT * FROM personnel WHERE matricule = ?";
    $resultat = $pdo->prepare($requete);
    $resultat->execute([$Matricule]);
    $personnelE = $resultat->fetch();

    $requetef = "SELECT * FROM service";
    $resultatf = $pdo->query($requetef);
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Editer personnel</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <?php include("menu.php"); ?>
        
        <div class="container">
            <div class="panel panel-primary" style="margin-top: 100px;">
                <div class="panel-heading">Veuillez saisir les données du personnel</div>
                <div class="panel-body">
                    <form method="post" action="updatePersonnel.php">
                        <div class="form-group">
                            <label for="matricule">Matricule : <?php echo $Matricule ?></label>
                            <input type="hidden" name="matricule" class="form-control" value="<?php echo $Matricule ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="ids" class="control-label">Nom service</label>
                            <select name="ids" id="ids" class="form-control">
                                <?php while ($service = $resultatf->fetch()) { ?>
                                    <option value="<?php echo $service['ids']; ?>" 
                                        <?php echo $personnelE['ids'] == $service['ids'] ? "selected" : ""; ?>>
                                        <?php echo $service['noms']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nomp">Nom du personnel :</label>
                            <input type="text" name="nomp" placeholder="Taper le nom du personnel" class="form-control" value="<?php echo $personnelE['nomp']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="prenomp">Prenom du personnel :</label>
                            <input type="text" name="prenomp" placeholder="Taper le prenom du personnel" class="form-control" value="<?php echo $personnelE['prenomp']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="num_tel">Numero du telephone :</label>
                            <input type="text" name="num_tel" placeholder="Taper le numero de telephone du personnel" class="form-control" value="<?php echo $personnelE['numero_telephone']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="date_naiss">Date de naissance :</label>
                            <input type="date" name="date_naiss" placeholder="Taper la date de naissance du personnel" class="form-control" value="<?php echo $personnelE['date_naissance']; ?>"/>
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




