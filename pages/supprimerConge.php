<?php
    session_start();
    if(isset($_SESSION['user'])){
        require_once('connexiondb.php');
        $idC=isset($_GET['idconge'])?$_GET['idconge']:0;
        $requete="delete from conge where idc=?";
        $params=array($idC);
        $resultat=$pdo->prepare($requete);
        $resultat->execute($params);
        header('location:conges.php');
    }else{
        header('location:login.php');
    }
?>