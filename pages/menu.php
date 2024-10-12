<?php
    require_once("identifier.php");
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid ">
        <div class="navbar-header">
            <a href="pagegarde.php" class="navbar-brand">Gestion </a>  
        </div>
        <ul class="nav navbar-nav">
            <li><a href="personnels.php">Les personnels</a></li>
            <li><a href="services.php">Les services</a></li>
            <li><a href="conges.php">Les congés</a></li>
            <?php if($_SESSION['user']['role']=='ADMIN') {?>
            <li><a href="utilisateurs.php">Les utilisateurs</a></li>
            <?php } ?>
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
            <li><a href="editerUtilisateur.php?id=<?php echo $_SESSION['user']['iduser'] ?>"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;<?php echo $_SESSION['user']['login']?></a></li>
            <li><a href="seDeconnecter.php"><i class="glyphicon glyphicon-log-out"></i>&nbsp;&nbsp;Se deconnecter</a></li>
        </ul>
    </div>      
</nav>
