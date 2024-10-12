<?php
    require_once("identifier.php");
    require_once('connexiondb.php');
    $requetes = "SELECT * FROM service";
    $resultats = $pdo->query($requetes);

    
?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Nouvel personnel</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <?php include("menu.php"); ?>
        
        <div class="container">
            <div class="panel panel-primary" style="margin-top: 100px;">
                <div class="panel-heading">Veuillez saisir les données du nouvel personnel</div>
                <div class="panel-body">
                   <!-- Message d'erreur si un champ est manquant -->
                <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
                    <div class="alert alert-danger" role="alert">
                        Il faut insérer toutes les données.
                    </div>
                <?php endif; ?>
                    
                    <form method="post" action="insertPersonnel.php">
                        <div class="form-group">
                            <label for="matricule">Matricule :</label>
                            <input type="text" name="matricule" placeholder="Taper le matricule du personnel" class="form-control">
                        </div>
                        <div class="form-group">
							<label for="idservice" class="control-label">Nom service</label>
							<select name="idservice" id="idservice" class="form-control">
								<?php while($service=$resultats->fetch()){ ?>
									<option value="<?php echo $service['ids']?>">
										<?php echo $service['noms']?>
									</option>
								<?php } ?>
							</select>
						</div>
                        <div class="form-group">
                            <label for="nomp">Nom du personnel :</label>
                            <input type="text" name="nomp" placeholder="Taper le nom du personnel" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="prenomp">Prenom du personnel :</label>
                            <input type="text" name="prenomp" placeholder="Taper le prenom du personnel" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="num_tel">Numero du telephone :</label>
                            <input type="text" name="num_tel" placeholder="Taper le numero du telephone du personnel" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="date_naiss">Date de naissance :</label>
                            <input type="date" name="date_naiss" placeholder="Taper le date de naissance du personnel" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">
                           <span class="glyphicon glyphicon-save"></span> Enregistrer
                        </button>   
                    </form>
                </div>
            </div>
        </div>
    </body>
</HTML>

