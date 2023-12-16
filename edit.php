<?php

session_start();

if ($_POST) {
    if (
        isset($_POST['nom']) &&
        isset($_POST['prenom']) &&
        isset($_POST['date']) &&
        isset($_POST['adresse'])
    ) {
        require_once('connect.php');

        $id = strip_tags($_POST['id']);
        $nom = strip_tags($_POST['nom']);
        $prenom = strip_tags($_POST['prenom']);
        $date = strip_tags($_POST['date']);
        $adresse = strip_tags($_POST['adresse']);

        $sql = 'UPDATE stagiaire SET nom=:nom, prenom=:prenom, date=:date, adresse=:adresse WHERE id=:id';
        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':nom', $nom);
        $query->bindValue(':prenom', $prenom);
        $query->bindValue(':date', $date);
        $query->bindValue(':adresse', $adresse);

        $query->execute();

        require_once('close.php');

        $_SESSION['apres_modif'] = $nom;



        header('Location: index.php');
    }
};

if (isset($_GET['id']) && !empty($_GET['id'])) {

    require_once('connect.php');

    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM stagiaire WHERE id=:id';
    $query = $db->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $result = $query->fetch();

    require_once('close.php');

    $_SESSION['update_confirm'] = "good";
    $_SESSION['nom_du_stagiaire'] = $result[1] .' '. $result[2];


}else{
    header('Location: index.php');
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modifier</title>
</head>

<body>

    <form method="post">
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" value="<?= $result['nom'] ?>" required>

            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" value="<?= $result['prenom'] ?>" required>

            <label for="date">Date</label>
            <input type="date" name="date" value="<?= $result['date'] ?>" required>

            <label for="nom">Adresse</label>
            <input type="text" name="adresse" value="<?= $result['adresse'] ?>" required>


            <input type="hidden" name="id" value="<?= $result['id'] ?>">
            <input type="submit" value="modifier"></input>
        </div>
    </form>
</body>

</html>