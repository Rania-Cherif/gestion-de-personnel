<?php
require_once('connexiondb.php');
require_once("identifier.php");

// Initialisation des variables
$idC = isset($_GET['idconge']) ? $_GET['idconge'] : "";
$type = isset($_GET['type']) ? $_GET['type'] : "tous";

// Préparation de la requête en fonction du type
$query = "SELECT idc, nomp, prenomp, type, debut_conge, fin_conge FROM personnel as p, conge as c WHERE p.idp=c.idp AND idc LIKE ?";
$params = ["%$idC%"];

if ($type != "tous") {
    $query .= " AND c.type = ?";
    $params[] = $type;
}

// Exécution de la requête
$stmt = $pdo->prepare($query);
$stmt->execute($params);

// Requête pour obtenir les types de congé
$requetec = "SELECT DISTINCT type FROM conge";
$resultatc = $pdo->query($requetec);

?>

<!DOCTYPE HTML>
<HTML>
<head>
    <meta charset="utf-8">
    <title>Les congés</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <?php include("menu.php"); ?>

    <div class="container">
        <div class="panel panel-success margetop">
            <div class="panel-heading">Recherche des congés...</div>
            <div class="panel-body">
                <form method="get" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="idconge" 
                               placeholder="Taper l'id de congé"
                               id="idconge" class="form-control" 
                               value="<?php echo $idC; ?>"/>
                    </div>
                    
                    <div class="form-group">
                        <select name="type" id="type" class="form-control" onChange="this.form.submit();">
                            <option value="tous">Tous les congés</option>
                            <?php while ($typeRow = $resultatc->fetch()) { ?>
                                <option value="<?php echo $typeRow['type']; ?>" <?php echo ($type == $typeRow['type']) ? 'selected' : ''; ?>>
                                    <?php echo $typeRow['type']; ?>
                                </option>                                    
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="glyphicon glyphicon-search"></i>
                        Chercher...
                    </button>
                    &nbsp;&nbsp;
                    <a href="conges.php" class="btn btn-danger">
                        <span class="glyphicon glyphicon-ok"></span>
                        Afficher tous
                    </a>
                    &nbsp;&nbsp;
                    <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                    <a href="nouvel_conge.php" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span> 
                        Nouveau congé
                    </a>
                    <?php } ?>
                </form>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">Liste des congés</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Congé</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Type</th>
                            <th>Date Début</th>
                            <th>Date Fin</th>
                            <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?><th>Actions</th><?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($conge = $stmt->fetch()) { ?>
                        <tr>
                            <td><?php echo $conge['idc']; ?></td>
                            <td><?php echo $conge['nomp']; ?></td>
                            <td><?php echo $conge['prenomp']; ?></td>
                            <td><?php echo $conge['type']; ?></td>
                            <td><?php echo $conge['debut_conge']; ?></td>
                            <td><?php echo $conge['fin_conge']; ?></td>
                            <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                            <td>
                                <a href="editerConge.php?idconge=<?php echo $conge['idc']; ?>">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                &nbsp;&nbsp;
                                <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer le congé?')" href="supprimerConge.php?idconge=<?php echo $conge['idc']; ?>">
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
</HTML>
