<?php
    session_start();
    if(isset($_SESSION['user'])){
        require_once('connexiondb.php');
        $Matricule=isset($_GET['matricule'])?$_GET['matricule']:0;
        $requete="delete from personnel where matricule=?";
        $params=array($Matricule);
        $resultat=$pdo->prepare($requete);
        $resultat->execute($params);
        header('location:personnels.php');
    }else{
        header('location:login.php');
    }
?>