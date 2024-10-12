<?php
    require_once("identifier.php");
    require_once('connexiondb.php');

    // Obtenir les types de congés
    $typeQuery = "SELECT DISTINCT type FROM conge";
    $typeStmt = $pdo->query($typeQuery);
    $types = $typeStmt->fetchAll(PDO::FETCH_ASSOC);

    // Obtenir les options pour le sélecteur de matricules
    $requetef = "SELECT * FROM personnel";
    $resultatf = $pdo->query($requetef);
?>

<!DOCTYPE HTML>
<HTML>
<head>
    <meta charset="utf-8">
    <title>Nouvel Congé</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <?php include("menu.php"); ?>
    
    <div class="container">
        <div class="panel panel-primary" style="margin-top: 100px;">
            <div class="panel-heading">Veuillez saisir les données du nouvel congé</div>
            <div class="panel-body">
                <form method="post" action="insertConge.php">
                     <div class="form-group">
                            <label for="matricule">Matricule :</label>
                            <input type="text" name="matricule" placeholder="Taper le matricule du personnel" class="form-control">
                        </div>
                        
                    <div class="form-group">
                        <label for="typeconge" class="control-label">Type :</label>
                        <select name="typeconge" id="typeconge" class="form-control">
                            <option value="">Sélectionner un type</option>
                            <?php foreach ($types as $t) {
                                $typeValue = htmlspecialchars($t['type']);
                                echo '<option value="' . $typeValue . '">' . ucfirst($typeValue) . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="datedebut">Date début :</label>
                        <input type="date" name="datedebut" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="datefin">Date fin :</label>
                        <input type="date" name="datefin" class="form-control">
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

