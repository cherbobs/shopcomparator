<?php
session_start();

require('config.php');

$methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");

if($methode == "POST")
{
    if(isset($_POST['submit'])){
        var_dump($methode);
        $name = filter_input(INPUT_POST, "name");
        $first_name = filter_input(INPUT_POST, "first_name");
        $username = filter_input(INPUT_POST, "username");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $adresse = filter_input(INPUT_POST, "adresse");
        var_dump($adresse);
        $num_tel = filter_input(INPUT_POST, "num_tel");
        $confirm_password = filter_input(INPUT_POST, "confirm_password");

        if($password == $confirm_password){
            
            $requete = $conn->prepare("INSERT INTO profil (username, email, password, first_name, name, num_tel, adresse) VALUES(:username, :email, :password, :first_name, :name, :num_tel, :adresse)");
            $requete->execute([
                ":name" => $name,
                ":first_name" => $first_name,
                ":username" => $username,
                ":email" => $email,
                ":password" => password_hash($password, PASSWORD_DEFAULT),
                ":num_tel" => $num_tel,
                ":adresse" => $adresse
            ]); 

            header("Location: login.php");
            exit();
        }
    }
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/register.css">
    <title>Inscription</title>
</head>
<body>
    <div class="container">
         <div class="logo">
            <a href=""><img src="../../images/BFO_logo_rgb.original.png" alt=""></a>   
        </div>

        <form class="form" action="" method="POST">

            <div class="firstname">
                <input type="text" class="box-input" name="firstname" value="" placeholder="Prénom" required>
            </div>            
            <div class="name">
                <input type="text" class="box-input" name="name" value="" placeholder="Nom" required>
            </div>
            <div class="username">
                <input type="text" class="box-input" name="username" value="" placeholder="Nom d'utilisateur" required>
            </div>
            <div class="email">
                <input type="email" class="box-input" name="email" value="" placeholder="Adresse email" required>
            </div>
            <div class="gender">Genre
                <input type="radio" id="man" name="gender" value="homme" />
                <label for="contactChoice1">Homme</label>

                <input type="radio" id="woman" name="gender" value="femme" />
                <label for="contactChoice2">Femme</label>

                <input type="radio" id="other" name="gender" value="autre" />
                <label for="contactChoice3">Autre</label>
            </div>
            <div class="mdp">
                <input type="password" class="box-input" name="password" value="" placeholder="Mot de passe" required>
            </div>
            <div class="mdp">
                <input type="password" class="box-input" name="confirm_password" value="" placeholder="Confirmez votre mot de passe" required>
            </div>
                

            <input type="submit" name="submit" value="Inscription" class="button">
            
        </form>

        <p class="box-register">Vous avez déjà un compte? <a href="login.php">Connectez-vous</a></p>
    </div>

</body>
</html>