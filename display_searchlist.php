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
    <link rel="preconnect" href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Karla' rel='stylesheet'>
    <link rel="stylesheet" href="./styles/display_search.css">
    <title>Rechercher</title>
</head>

<header id="header">
    <div class="logo">
        <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                <path d="M6.10645 4.01889L21.8078 1" stroke="#80A9EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6.13527 27.0002C9.69248 27.0002 10.7083 24.312 11.2263 22.3352C11.394 21.6951 10.8926 21.0591 10.2309 21.0591H6.86744H1.87903C1.19889 21.0591 0.697255 21.7294 0.891875 22.3811C1.50832 24.4453 2.52897 27.0002 6.13527 27.0002Z" fill="#80A9EF" stroke="#80A9EF" stroke-linejoin="round"/>
                <path d="M1.22925 21.3533L5.92208 4.01904L10.8367 21.3533" stroke="#80A9EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M22.2576 23.9811C25.8148 23.9811 26.8307 21.293 27.3486 19.3161C27.5163 18.6761 27.0149 18.04 26.3532 18.04H22.9898H18.0013C17.3212 18.04 16.8196 18.7104 17.0142 19.3621C17.6306 21.4262 18.6513 23.9811 22.2576 23.9811Z" fill="#80A9EF" stroke="#80A9EF" stroke-linejoin="round"/>
                <path d="M17.3517 18.3343L21.9371 1L26.9591 18.3343" stroke="#80A9EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <div class="content">SHOPCOMPARATOR</div>
    </div>
</header>

<body>
    <div class="screenview">
        <div class="recherche-retour">
                <div class="arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
                    <path d="M25 7L13 19L25 31" stroke="#144B90" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <form name="searchbar" action="" method="get">
                    <input type="text" class="searchbar" name="keywords" id="" placeholder="Rechercher">
                    <input type="submit" class="submit" value="Rechercher" name="valider">
                </form>
            </div>


        <?php if (@$afficher){ ?>
            <div id="resultats">
                <?php foreach (@$liste as $resultat) { ?>
                    <div class="resultat" id="<?= $resultat['id']?>" onclick="location.href='produit.php?id=<?= $resultat['id'] ?>'">
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
    </div>
</body>
</html>
