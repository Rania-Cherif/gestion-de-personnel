<?php
require_once("identifier.php");
require_once('connexiondb.php');

// Récupération des données du formulaire
$Matricule = isset($_POST['matricule']) ? trim($_POST['matricule']) : '';
$type = isset($_POST['typeconge']) ? trim($_POST['typeconge']) : '';
$debutC = isset($_POST['datedebut']) ? trim($_POST['datedebut']) : '';
$finC = isset($_POST['datefin']) ? trim($_POST['datefin']) : '';

// Vérifier si le matricule existe dans la table personnel
$stmt = $pdo->prepare("SELECT idp FROM personnel WHERE matricule = ?");
$stmt->execute([$Matricule]);
$idp = $stmt->fetchColumn();

if (!$idp) {
    // Si le matricule n'existe pas, afficher un message d'erreur
    echo "Le matricule spécifié n'existe pas dans la table personnel.";
    exit();
}

// Préparer et exécuter la requête d'insertion dans conge
$requete = "INSERT INTO conge (idp, type, debut_conge, fin_conge) VALUES (?, ?, ?, ?)";
$params = array($idp, $type, $debutC, $finC);


    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    header('Location: conges.php');

?>


