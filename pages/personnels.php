<?php
require_once("identifier.php");
require_once("connexiondb.php");

$matricule = isset($_GET['matricule']) ? $_GET['matricule'] : "";
$nomPrenom = isset($_GET['nomPrenom']) ? $_GET['nomPrenom'] : "";

$error = "";
$noResultError = "";

if (!empty($matricule) && !empty($nomPrenom)) {
    $error = "Veuillez remplir soit le matricule soit le nom, mais pas les deux à la fois.";
} else {
    if (!empty($matricule)) {
        $query = "SELECT p.matricule, s.noms, p.nomp, p.prenomp, p.numero_telephone, p.date_naissance
                  FROM personnel p, service s
                  WHERE p.ids = s.ids
                  AND p.matricule = :matricule";
        $statement = $pdo->prepare($query);
        $statement->execute(['matricule' => $matricule]);
    } else {
        $query = "SELECT p.matricule, s.noms, p.nomp, p.prenomp, p.numero_telephone, p.date_naissance
                  FROM personnel p, service s
                  WHERE p.ids = s.ids
                  AND (p.nomp LIKE :nomPrenom OR p.prenomp LIKE :nomPrenom)";
        $statement = $pdo->prepare($query);
        $statement->execute(['nomPrenom' => "%$nomPrenom%"]);
    }

    // Vérifiez si aucun résultat n'est trouvé
    if ($statement->rowCount() == 0) {
        $noResultError = "Aucun personnel trouvé pour cette recherche.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gestion des personnels</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <?php include("menu.php"); ?>
    
    <div class="container">
        <div class="panel panel-success margetop">
            <div class="panel-heading">Recherche des personnels..</div>
            <div class="panel-body">
                <?php if (!empty($error)) { ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>
                <form method="get" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="matricule" placeholder="Taper le matricule" class="form-control" value="<?php echo htmlspecialchars($matricule); ?>">
                    </div>&nbsp;&nbsp;
                    <div class="form-group">
                        <input type="text" name="nomPrenom" placeholder="Taper le nom du personnel" class="form-control" value="<?php echo htmlspecialchars($nomPrenom); ?>">
                    </div>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span>
                        Recherche...
                    </button>
                    &nbsp;&nbsp;
                    <a href="personnels.php" class="btn btn-danger">
                        <span class="glyphicon glyphicon-ok"></span>
                        Afficher tous
                    </a>
                    &nbsp;&nbsp;
                    <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                    <a href="nouvelPersonnel.php" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span>
                        Nouvel personnel
                    </a>
                    <?php } ?>
                </form>  
            </div>
        </div>
        
        <div class="panel panel-primary">
            <div class="panel-heading">Liste des personnels</div>
            <div class="panel-body">
                <?php if (!empty($noResultError)) { ?>
                    <div class="alert alert-warning">
                        <?php echo $noResultError; ?>
                    </div>
                <?php } ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Matricule</th><th>Nom service</th><th>Nom</th><th>Prenom</th><th>num tel</th><th>date-naiss</th>
                            <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?><th>Action</th><?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while (isset($statement) && $personnel = $statement->fetch()) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($personnel['matricule']); ?></td>
                                <td><?php echo htmlspecialchars($personnel['noms']); ?></td>
                                <td><?php echo htmlspecialchars($personnel['nomp']); ?></td>
                                <td><?php echo htmlspecialchars($personnel['prenomp']); ?></td>
                                <td><?php echo htmlspecialchars($personnel['numero_telephone']); ?></td>
                                <td><?php echo htmlspecialchars($personnel['date_naissance']); ?></td>
                                <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                <td>
                                    <a href="editerPersonnel.php?matricule=<?= htmlspecialchars($personnel['matricule']); ?>">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                    &nbsp;&nbsp;
                                    <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer le personnel?')" href="supprimerPersonnel.php?matricule=<?= htmlspecialchars($personnel['matricule']); ?>">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>







