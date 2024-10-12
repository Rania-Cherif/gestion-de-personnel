<?php
    require_once("identifier.php");
    require_once('connexiondb.php');
    $nomS=$_POST['noms'];
    
    $requete="insert into service(noms) values(?)";
    $params=array($nomS);

    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    
    header('location:services.php');


?>

  