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
        $gender = filter_input(INPUT_POST, "gender");
        $confirm_password = filter_input(INPUT_POST, "confirm_password");

        if($password == $confirm_password){
            
            $requete = $pdo->prepare("INSERT INTO profil ( firstname, name, username, email, gender, password ) VALUES(:first_name, :name, :username, :email, :gender, :password )");
            $requete->execute([
                ":first_name" => $first_name,
                ":name" => $name,
                ":username" => $username,
                ":email" => $email,
                ":gender" => $gender,
                ":password" => password_hash($password, PASSWORD_DEFAULT)

            ]); 

            header("Location: login.php");
            exit();
        }
    }
} 
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Karla' rel='stylesheet'>
    <link rel="stylesheet" href="./styles/register.css">
    <title>Inscription</title>
</head>
<body>
<div class="logo"> 
          <div class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                <path d="M9.73584 6.704L34.2015 2" stroke="#80A9EF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9.78081 42.513C15.7655 42.513 17.1337 37.6299 17.8934 34.5312C18.0509 33.8885 17.5593 33.2556 16.8976 33.2556H10.9217H2.37903C1.69889 33.2556 1.20695 33.9231 1.39504 34.5767C2.34689 37.8844 3.72174 42.513 9.78081 42.513Z" fill="#80A9EF" stroke="#80A9EF" stroke-linejoin="round"/>
                <path d="M2.13623 33.7142L9.44856 6.7041L17.1064 33.7142" stroke="#80A9EF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M34.9024 37.8089C40.8871 37.8089 42.2553 32.9257 43.0149 29.8271C43.1725 29.1844 42.6808 28.5515 42.0192 28.5515H36.0433H27.5006C26.8205 28.5515 26.3285 29.219 26.5166 29.8726C27.4685 33.1803 28.8433 37.8089 34.9024 37.8089Z" fill="#80A9EF" stroke="#80A9EF" stroke-linejoin="round"/>
                <path d="M27.2578 29.0101L34.4027 2L42.228 29.0101" stroke="#80A9EF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
          </div>

          <div class="content">SHOPCOMPARATOR</div>
        </div>

    <form class="form" action="" method="POST">
        <div class="inputs">
            <input type="text" class="box-input" name="first_name" value="" placeholder="Prénom" required>           

            <input type="text" class="box-input" name="name" value="" placeholder="Nom" required>

            <input type="text" class="box-input" name="username" value="" placeholder="Nom d'utilisateur" required>

            <input type="email" class="box-input" name="email" value="" placeholder="Adresse email" required>

            <div class="gender">Genre
                <div class="genre">
                    <div class="choice">
                        <input type="radio" id="man" name="gender" value="homme"  />
                        <label for="homme">Homme</label>
                    </div>

                    <div class="choice">
                        <input type="radio" id="woman" name="gender" value="femme" />
                        <label for="femme">Femme</label>
                    </div>

                    <div class="choice">
                        <input type="radio" id="other" name="gender" value="autre" />
                        <label for="autre">Autre</label>
                    </div>

                </div>
            </div>

            <input type="password" class="box-input" name="password" value="" placeholder="Mot de passe" required>

            <input type="password" class="box-input" name="confirm_password" value="" placeholder="Confirmez votre mot de passe" required>

        </div> 

            <input type="submit" name="submit" value="Inscription" class="inscription" id="inscription">

    </form>

    <div class="connexion">Vous avez déjà un compte? &nbsp<a href="login.php">Connectez-vous</a></div>

</body>
</html>