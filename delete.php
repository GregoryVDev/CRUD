<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {

    require_once('connect.php');

    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM stagiaire WHERE id=:id';
    $query = $db->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $result = $query->fetch();

    // Si aucun résultat est trouvé dans le $result alors il nous envoie vers index.php
    if(!$result)
    {
        header('Location: index.php');
    }

    $sql = 'DELETE FROM stagiaire WHERE id=:id';
    $query = $db->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    require_once('close.php');
    header('Location: index.php');

    session_start();

    $_SESSION['delete_confirm'] = true;
    $_SESSION['stagiaire_delete_id'] = $id;
    $_SESSION['nom_stagiaire'] = $result[1].' '.$result[2];

} else {
    header('Location: index.php');
}


?>