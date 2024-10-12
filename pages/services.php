<?php
    

require_once("identifier.php");

require_once("connexiondb.php");

// Récupération de l'ID ou du nom depuis l'URL
$idS = isset($_GET['id']) ? $_GET['id'] : "";
$nomS = isset($_GET['noms']) ? $_GET['noms'] : "";

if (!empty($idS) && !empty($nomS)) {
    // Si les deux sont fournis, on ne peut pas les rechercher ensemble, affichez une erreur
    echo '<div class="alert alert-danger">Veuillez rechercher par ID ou par nom, mais pas les deux en même temps.</div>';
    exit; // Arrête l'exécution du script ici
}

if (!empty($idS)) {
    $requete = "SELECT * FROM service WHERE ids = :idS";
    $stmt = $pdo->prepare($requete);
    $stmt->execute(['idS' => $idS]);
} else {
    $requete = "SELECT * FROM service WHERE noms LIKE :nomS";
    $stmt = $pdo->prepare($requete);
    $stmt->execute(['nomS' => "%$nomS%"]);
}

$resultatS = $stmt;
$services = $resultatS->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gestion des services</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <?php include("menu.php"); ?>
    
    <div class="container">
        <div class="panel panel-success margetop">
            <div class="panel-heading">Recherche des services...</div>
            <div class="panel-body">
                <form method="get"  class="form-inline">
                    <div class="form-group">
                        <input type="text" name="id" placeholder="Taper l'ID du service" class="form-control">
                    </div>&nbsp;&nbsp;
                    <div class="form-group">
                        <input type="text" name="noms" placeholder="Taper le nom du service" class="form-control">
                    </div>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span>
                        Recherche...
                    </button>
                    &nbsp;&nbsp;
                    <a href="services.php" class="btn btn-danger">
                        <span class="glyphicon glyphicon-ok"></span>
                        Afficher tous
                    </a>
                    &nbsp;&nbsp;
                    <?php if($_SESSION['user']['role']=='ADMIN') {?>
                        <a href="nouvel service.php" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus"></span>
                            Nouvel service
                        </a>
                    <?php } ?>
                    
                </form>  
            </div>
        </div>
        
        <div class="panel panel-primary">
            <div class="panel-heading">Liste des services</div>
            <div class="panel-body">
                <?php if (empty($services)) { ?>
                    <?php if (!empty($idS) && !empty($nomS)) { ?>
                        <div class="alert alert-danger">Veuillez rechercher par ID ou par nom, mais pas les deux en même temps.</div>
                    <?php } else { ?>
                        <div class="alert alert-danger">Aucun service trouvé.</div>
                    <?php } ?>
                <?php } else { ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id service</th><th>Nom service</th><?php if($_SESSION['user']['role']=='ADMIN') {?><th>Actions</th><?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($services as $service) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($service['ids']); ?></td>
                                    <td><?php echo htmlspecialchars($service['noms']); ?></td>
                                    <?php if($_SESSION['user']['role']=='ADMIN') {?>
                                       <td>&nbsp;&nbsp;
                                        
                                           <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer le service?')"
                                              href="supprimerService.php?idservice=<?= htmlspecialchars($service['ids']); ?>">
                                              <span class="glyphicon glyphicon-trash"></span>
                                           </a>
                                        
                                       </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>
