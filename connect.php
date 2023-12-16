<?php

try {
    // Connexion à la base
    $server_name = "localhost";
    $db_name = "crud";
    $user_name = "root";
    $password = "root";

    $db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8mb4", "$user_name", "$password");

    // echo "Connexion réussie";
}catch (PDOException $e) {
    echo "Echec de connexion:" . " " . $e->getMessage();
};

?>