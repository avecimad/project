<?php

require('db_connectie.php');
 session_start();
  

if (!isset($_SESSION['loggedInUser'])) {
    header('Location: insert.php');
} else {
    session_destroy();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? null;
    $rating = $_POST['rating'] ?? null;
    $summary = $_POST['summary'] ?? null;
    $awards = $_POST['has_won_awards'] ?? null;
    $seasons = $_POST['seasons'] ?? null;
    $country = $_POST['country'] ?? null;
    $taal = $_POST['spoken_in_language'] ?? null;
    $trailer = $_POST['youtube_trailer_id'] ?? null;
    $duur = $_POST['length_in_minutes'] ?? null;
    $datum = $_POST['released_at'] ?? null;
    $soort = $_POST['soort'] ?? null;

    if ($soort == "films") {
        $sql = "INSERT INTO media (`title`, `summary`, `length_in_minutes`, `released_at`, `country`, `youtube_trailer_id`, `soort`) 
    VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $summary, $duur, $datum, $country, $trailer, $soort]);
    } elseif ($soort == "series") {
        $sql = "INSERT INTO media (`title`, `rating`, `has_won_awards`, `seasons`, `country`, `spoken_in_language`, `summary`, `soort`)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $rating, $awards, $seasons, $country, $taal, $summary,  $soort]);
    } else {
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>mediatheek</title>

</head>

<body>
    <script>
        let var1 = <? $_POST['']; ?>
    </script>
    <form method="POST" action="">
        <a href="index.php"><button type="button" class="container">terug</button></a>
        <h1>nieuwe media</h1>
        <table class="inserttable">
            <tr>
                <td><label for="title">Titel:</label></td>
                <td><input type="text" id="title" name="title"></td>
            </tr>
            <tr>
                <td><label for="rating">Rating:</label></td>
                <td><input type="text" id="rating" name="rating"></td>
            </tr>
            <tr>
                <td><label for="summary">omschrijving:</label></td>
                <td><textarea id="summary" name="summary">omschrijving</textarea></td>
            </tr>
            <tr>
                <td><label for="has_won_awards">Awards:</label></td>
                <td><input type="text" id="has_won_awards" name="has_won_awards"></td>
            </tr>
            <tr>
                <td><label for="length_in_minutes">duur:</label></td>
                <td><input type="text" id="length_in_minutes" name="length_in_minutes"></td>
            </tr>
            <tr>
                <td><label for="released_at">datum:</label></td>
                <td><input type="date" id="released_at" name="released_at"></td>
            </tr>
            <tr>
                <td><label for="seasons">Season:</label></td>
                <td><input type="text" id="seasons" name="seasons"></td>
            </tr>
            <tr>
                <td><label for="country">Country:</label></td>
                <td><input type="text" id="country" name="country"></td>
            </tr>
            <tr>
                <td><label for="spoken_in_language">taal:</label></td>
                <td><input type="text" id="spoken_in_language" name="spoken_in_language"></td>
            </tr>
            <tr>
                <td><label for="youtube_trailer_id">trailer id:</label></td>
                <td><input type="text" id="youtube_trailer_id" name=""></td>
            </tr>
            <tr>
                <td><label for="soort">type media:</label></td>
                <td>
                    <select name="soort" id="soort" class="option">
                        <option value="series" id="soort" name="soort">serie</option>
                        <option value="films" id="soort" name="soort">film</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" class="voegtoe">voeg toe</button></td>
            </tr>
        </table>
    </form>