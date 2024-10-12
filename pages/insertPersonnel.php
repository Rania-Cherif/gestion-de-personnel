<?php
    require_once("identifier.php");
    require_once('connexiondb.php');

    $Matricule=$_POST['matricule'];
    $idS=$_POST['idservice'];
    $nomP=$_POST['nomp'];
    $prenomP=$_POST['prenomp'];
    $numP=$_POST['num_tel'];
    $dateP=$_POST['date_naiss'];
    
    if (empty($Matricule) || empty($idS) || empty($nomP) || empty($prenomP) || empty($numP) || empty($dateP)) {
    header('Location: nouvelPersonnel.php?error=1'); // Redirection avec un indicateur d'erreur
    
}
    else{
    $requete="insert into personnel(matricule,ids,nomp,prenomp,numero_telephone,date_naissance) values(?,?,?,?,?,?)";
    $params=array($Matricule,$idS,$nomP,$prenomP,$numP,$dateP);

    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    
    header('location:personnels.php');
    }

?>

