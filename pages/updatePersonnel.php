<?php
    require_once("identifier.php");
    require_once('connexiondb.php');

    
    $Matricule = $_POST['matricule'];
    $idS = $_POST['ids'];
    $nomP = $_POST['nomp'];
    $prenomP = $_POST['prenomp'];
    $numP = $_POST['num_tel'];
    $dateP = $_POST['date_naiss'];

    
    $requete = "UPDATE personnel SET ids = ?, nomp = ?, prenomp = ?, numero_telephone = ?, date_naissance = ? WHERE matricule = ?";
    $params = array($idS, $nomP, $prenomP, $numP, $dateP, $Matricule);

    
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);

    
    header('Location: personnels.php');
    
?>



  