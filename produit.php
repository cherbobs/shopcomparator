<?php 
include("config.php");

@$id_produit = $_GET["id"];


if (isset($id_produit)){
    $requete = $pdo->prepare("SELECT * FROM product WHERE id = :id_product");
    $requete->execute([
        ":id_product" => $id_produit
    ]);
    $produit=$requete->fetch(PDO::FETCH_ASSOC);

    $requete = $pdo->prepare("SELECT * FROM price WHERE product_id = :id_product ORDER BY price");
    $requete->execute([
        ":id_product" => $id_produit
    ]);
    @$prices=$requete->fetchAll();

}



?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Karla' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/produit.css">
    <title>Produit</title>
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
    <div class="fiche">
        <div class="arrow-back">
            <div class="arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
                    <path d="M25 7L13 19L25 31" stroke="#144B90" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <div class="titre-nutriscore">
            <h1><?= $produit['name']?></h1>
            <img src="./sprites/nutriscore/<?= $produit['nutriscore']?>.png"/>
        </div>

        <div class="photo-produit">
            <div class="photo-container">
                <img src="<?= $produit['image']?>"/>
            </div>
        </div>

        <div class="description">
            <h3>Description</h3>
            <p><?= $produit['description'] ?></p>
        </div>

        <div class="ingredients-allergenes">
            <h3>Ingrédients et allergènes</h3>
            <p><?= $produit['ingredients'] ?></p>
        </div>

        <div class="liste-stores">
            <?php foreach (@$prices as $price) { 
                $requete = $pdo->prepare("SELECT * FROM store WHERE id = :id_store");
                $requete->execute([
                    ":id_store" => $price['store_id']
                ]);
                $store=$requete->fetch(PDO::FETCH_ASSOC);
                ?>
                <div id="store">
                    <div class="logo">
                        <img src="./sprites/stores/<?= $store['image'] ?>.png" />
                    </div>

                    <div class="name-store">
                        <h5><?= $store['name'] ?></h5>
                    </div>

                    <div class="price">
                        <h2><?= $price['price'] ?></h2>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
