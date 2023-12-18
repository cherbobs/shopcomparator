<?php 
include("config.php");


@$keywords = $_GET["keywords"];
@$valider = $_GET["valider"];

if (isset($valider) && !empty(trim($keywords))){
    $requete = $pdo->prepare("SELECT * FROM product WHERE name like '%$keywords%'");
    $requete->setFetchMode(PDO::FETCH_ASSOC);
    $requete->execute();

    $liste=$requete->fetchAll();
    $afficher = "oui";
}

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher</title>
</head>
<body>
    <form name="searchbar" action="" method="get">
        <input type="text" name="keywords" id="" placeholder="Rechercher">
        <input type="submit" value="Rechercher" name="valider">
    </form>
    <?php if (@$afficher = "oui"){ ?>
    <div id="resultats">
        <div id="resultat">
            <div id="name"></div>
        </div>
    </div>
    <?php } ?>
</body>
</html>
