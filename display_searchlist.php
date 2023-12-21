<?php 
include("config.php");


@$keywords = $_GET["keywords"];
@$valider = $_GET["valider"];
@$id_category = $_GET["id"];


if (isset($valider) && !empty(trim($keywords))){
    $requete = $pdo->prepare("SELECT * FROM product WHERE name like '%$keywords%'");
    $requete->setFetchMode(PDO::FETCH_ASSOC);
    $requete->execute();

    @$liste=$requete->fetchAll();
    $afficher = True;
}

if (isset($id_category)){
    var_dump($id_category);
    $requete = $pdo->prepare("SELECT * FROM product WHERE category_id = :category_id");
    $requete->execute([
        ":category_id" => $id_category
    ]);

    @$liste=$requete->fetchAll();
    $afficher = True;
    @$cat =True;

    $requete = $pdo->prepare("SELECT * FROM category ORDER BY id");
    $requete->setFetchMode(PDO::FETCH_ASSOC);
    $requete->execute();
    $categories=$requete->fetchAll();
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
<div class="recherche-retour">
            <div class="arrow">
            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
            <path d="M25 7L13 19L25 31" stroke="#144B90" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            </div>
            <form name="searchbar" action="" method="get">
            <input type="text" name="keywords" id="" placeholder="Rechercher">
            <input type="submit" value="Rechercher" name="valider">
            </form>
        </div>

    <?php if (@$cat){ ?>
        <div id="categories">
            <div class="liste-categories">
                <?php foreach (@$categories as $category) { ?>
                    <div class="cat">
                        <h2><?= $category['name'] ?></h2>
                    </div>
                <?php } ?> 
            </div>
        </div> 
    <?php } ?>  

    <?php if (@$afficher){ ?>
        <div id="resultats">
            <?php foreach (@$liste as $resultat) { ?>
                <div class="resultat" id="<?= $resultat['id']?>" onclick="location.href='produit.html?id=<?= $resultat['id'] ?>'">
                    <div class="photo-produit">
                        <img src="<?= $resultat['image']?>" />
                    </div>

                    <div class="description-container">
                        <div class="description-produit">
                            <h4><?= $resultat['name']?></h4>
                            <p>14 magasins</p>  
                        </div>
                    </div>

                    <div class="right-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect width="24" height="24" rx="12" fill="#144B90"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.3328 7.25102C12.6078 6.94231 13.0815 6.91451 13.3909 7.18891L18.7484 11.941C18.9085 12.083 19 12.2864 19 12.5C19 12.7136 18.9085 12.917 18.7484 13.059L13.3909 17.8111C13.0815 18.0855 12.6078 18.0577 12.3328 17.749C12.0578 17.4403 12.0856 16.9676 12.395 16.6932L16.2793 13.2479H5.74948C5.33555 13.2479 5 12.913 5 12.5C5 12.087 5.33555 11.7521 5.74948 11.7521H16.2793L12.395 8.30685C12.0856 8.03244 12.0578 7.55973 12.3328 7.25102Z" fill="#FEFDF8"/>
                    </svg>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</body>
</html>
