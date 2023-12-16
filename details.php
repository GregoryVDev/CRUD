<?php

session_start();

if(
    isset($_GET['id']) && !empty($_GET['id'])){

        require_once('connect.php');

        $id = strip_tags($_GET['id']);

        $sql = 'SELECT * FROM stagiaire WHERE id=:id';
        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);

        $query->execute();

        $result = $query->fetch();

        if(!$result) {
            header('Location: index.php');
        }
    }else{
        header('Location: index.php');
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Fiche du stagiaire</title>
</head>
<body>

<h1>Fiche du stagiaire</h1>
<h2><?= $result['nom'] .' '. $result['prenom'] ?></h2>

<p>Nom : <?= $result['nom'] ?></p>
<p>Prénom : <?= $result['prenom'] ?> </p>
<p>Date : <?= $result['date'] ?></p>
<p>Adresse : <?= $result['adresse'] ?></p>
    
</body>
</html>