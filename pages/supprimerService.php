<?php
    session_start();
    if(isset($_SESSION['user'])){
        require_once('connexiondb.php');
        $idS=isset($_GET['idservice'])?$_GET['idservice']:0;
        $requete="delete from service where ids=?";
        $params=array($idS);
        $resultat=$pdo->prepare($requete);
        $resultat->execute($params);
        header('location:services.php');
    }else{
        header('location:login.php');
    }
?>