<?php
    require_once("identifier.php");
    require_once('connexiondb.php');

    $idC = $_POST['idconge'];
    $type = $_POST['typeconge'];
    $debut_conge = $_POST['debut_conge'];
    $fin_conge = $_POST['fin_conge'];

    $requete = "UPDATE conge SET type = ?, debut_conge = ?, fin_conge = ? WHERE idc = ?";
    $params = array($type, $debut_conge, $fin_conge, $idC);

    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);

    header('Location: conges.php');
?>
