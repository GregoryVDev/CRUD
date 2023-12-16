<?php

session_start();

if ($_POST) {
    if (
        isset($_POST["nom"]) &&
        isset($_POST["prenom"]) &&
        isset($_POST["date"]) &&
        isset($_POST["adresse"])
    ) {

        require_once("connect.php");

        $nom = strip_tags($_POST["nom"]);
        $prenom = strip_tags($_POST["prenom"]);
        $date = strip_tags($_POST["date"]);
        $adresse = strip_tags($_POST["adresse"]);

        $sql = "INSERT INTO stagiaire (nom, prenom, date, adresse) VALUES (:nom, :prenom, :date, :adresse)";
        $query = $db->prepare($sql);

        $query->bindValue(":nom", $nom);
        $query->bindValue(':prenom', $prenom);
        $query->bindValue(':date', $date);
        $query->bindValue(':adresse', $adresse);

        $query->execute();

        require_once("close.php");

        $_SESSION['add_confirm'] = "confirm";

        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ajouter un stagiaire</title>
</head>
<body>
    <h1>Ajouter des stagiaires</h1>
    <form method="post">
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" required>

            <label for="prenom">Prénom</label>
            <input for="text" name="prenom" required>

            <label for="date">date</label>
            <input type="date" name="date" required>

            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" required>
        </div>
        <input type="submit" value="send"></input>
    </form>
</body>

</html>