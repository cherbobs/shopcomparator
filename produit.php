<?php 
include("config.php");

@$id_produit = $_GET["id"];


if (isset($id_produit)){
    var_dump($id_produit);
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
    <title>Produit</title>
</head>
<body>
    <div class="arrow-retour">
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
</body>
</html>
