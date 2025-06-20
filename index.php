<?php

include "db_connectie.php";


session_start();

if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    die;
}


if (isset($_GET['seriesordedby'])) {
    $Link1 = '&seriesordedby=rating';
    $query = $pdo->query('SELECT * FROM media WHERE soort = "series" ORDER BY rating DESC;');
} else {
    $Link1 = '';
    $query = $pdo->query('SELECT * FROM media WHERE soort = "series"');
}

if (isset($_GET['moviesorderdby'])) {
    $Link2 = '&moviesorderdby=duur';
    $query2 = $pdo->query('SELECT id, title, length_in_minutes, soort FROM media ORDER BY length_in_minutes DESC');
} else {
    $Link2 = '';
    $query2 = $pdo->query('SELECT * FROM media WHERE soort = "films"');
}
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$result2 = $query2->fetchAll(PDO::FETCH_ASSOC);

?>
<html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>

</head>

<body>
    <h1>Welkom op het netland beheerders paneel</h1>
    <a href="logout.php" class="uitloggen">Uitloggen</a>

    <h2>Series</h2>
    <?php
    echo "<table><tr><td class='text'>title</td><td class='number'><a href='?seriesordedby=rating" . $Link2 . "'>rating</a></td><td class='text'>details</td></tr>";
    foreach ($result as $key => $value) {
        $id = $value['id'];
        $title = $value['title'];
        $rating = $value['rating'];
        echo "<tr><td class='text'>$title</td><td class='number'>$rating</td><td class='text'><a href='detail.php?id=$id'> Bekijk details</a></td></tr>";
    }

    ?>

    </table>
    <h2>Films</h2>
    <?php
    echo "<table><tr><td class='text'>title</td><td class='number'><a href='?moviesorderdby=duur" . $Link1 . "'>duur</a></td><td class='text'>details</td></tr>";
    foreach ($result2 as $key => $value) {
        $id = $value['id'];
        $title = $value['title'];
        $duur = $value['length_in_minutes'];
        echo "<tr><td class='text'>$title</td><td class='number'>$duur</td><td class='text'><a href='detail.php?id=$id'> Bekijk details</a></td></tr>";
    }
    echo "<td colspan='3' class='text toevoegen'><a href='insert.php'>media toevoegen</a></td></tr>";
    ?>
    </table>
</body>

</html>