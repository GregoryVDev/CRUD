<?php 

session_start();

require_once("connect.php");

$sql = "SELECT * FROM stagiaire";
$query = $db->prepare($sql);

$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Stagiaires</title>
</head>
<body>
    <h1>Les Stagiaires</h1>

    <?php if(isset($_SESSION['delete_confirm']) && $_SESSION['delete_confirm'] === true) : ?>
    <div><p><?= $_SESSION['nom_stagiaire'] ?> a été retiré(e).</p></div>
    <?php unset($_SESSION['delete_confirm']); ?>
    <?php endif; ?>

    <?php if(isset($_SESSION['update_confirm']) && $_SESSION['update_confirm'] === "good" && isset($_SESSION['apres_modif'])) { ?>
    <div><p>La fiche de <?= $_SESSION['nom_du_stagiaire'] ?> a été modifiée.</p></div>
    <?php unset($_SESSION['update_confirm'], $_SESSION['apres_modif']); }?>

    <?php if(isset($_SESSION['add_confirm']) && $_SESSION['add_confirm'] === "confirm") { ?>
    <div><p>Une fiche de stagiaire a été ajoutée.</p></div>
    <?php unset($_SESSION['add_confirm']);} ?>




    


    <table>
        <thead>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date</th>
            <th>Adresse</th>
        </thead>
        <?php foreach($result as $stagiaire): ?>
        <tbody>
            <tr>
                <td><?= $stagiaire['nom'] ?></td>
                <td><?= $stagiaire['prenom'] ?></td>
                <td><?= $stagiaire['date'] ?></td>
                <td><?= $stagiaire['adresse'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $stagiaire["id"] ?>">Modifier</a>
                    <a href="delete.php?id=<?= $stagiaire["id"] ?>">Supprimer</a>
                    <a href="details.php?id=<?= $stagiaire["id"] ?>">Détailler</a>
                </td>
            </tr>
        </tbody>
        <?php endforeach; ?>
    </table>
    <a href="add.php">Ajouter</a>
</body>
</html>