<?php
    session_start();
    
    require('config.php');
    
    $methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
    $error = null;
    
    if ($methode == "POST") {
      $login = filter_input(INPUT_POST, "login");
      $password = filter_input(INPUT_POST, "password");
      $_SESSION["email"]=$login;
    
      $requete = $pdo->prepare("SELECT * FROM profil WHERE email = :login");
      $requete->execute([":login" => $login]);
    
      $user = $requete->fetch(PDO::FETCH_ASSOC);
      var_dump($user);
      var_dump($_SESSION);
      $_SESSION["id_user"]=$user['id_user'];
      $_SESSION["username"]=$user['username'];
    
    var_dump(password_hash($password, PASSWORD_DEFAULT));
    var_dump($user["password"]);
      if (password_verify($password, $user["password"])) {
    
        $_SESSION["loggedin"] = true;
        $error = null;
        
        $token = uniqid('', true);
        $_SESSION['token']=$token;
    
        $requete1 = $pdo->prepare("UPDATE profil SET token = :token WHERE email = :login");
        $requete1->execute([":token" => $token, ":login" => $login]);
        if($user['role'] == "public"){
          header('Location: accueil.php');
        }else{
          header('Location: ../../interne/SCRIPT/accueil_interne.html');
        }

      } else {
        $error = "Identifiants invalides";
        var_dump($error);
      }
    }
    ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./styles/login.css" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Karla' rel='stylesheet'>
        <title>Connexion</title>
    </head>

    <body>
      <div class="logo-form">

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
            
        <form action="" class="form" method="POST">

          <div class="container-input">
            <input class="saisir" placeholder="Adresse mail" type="text" name="login" id="login"> 
            
            <div class="password">
              <input class="saisir" placeholder="Mot de passe" type="password" name="password" id="password">
              <p class="mdp_oublie"><a href="#">Mot de passe oublié</a></p>
            </div>
          </div>
          <input type="submit" name="submit" value="Connexion" class="connexion" />
        </form>
      </div>

          <div class="inscription"> Vous n'avez pas de compte? &nbsp <a href="register.php"> Inscrivez-vous</a></div>
    </body>
    
</html>