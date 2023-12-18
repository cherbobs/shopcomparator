<?php
// Informations d'identification
$servername = "localhost";
$username = "root";
$password = "";
$pdo = new PDO("mysql:host=$servername;dbname=shopcomparator", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>