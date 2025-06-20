<?php

require('db_connectie.php');
session_start();
$id = $_GET['id'] ?? null; // Gebruik 'null' in kleine letters
$stmt = $pdo->prepare("SELECT * FROM media WHERE id = ?");
$stmt->execute([$id]);
$value = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
$soort = $value['soort'];;
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: edit.php?id=$id");
    exit;
}



$id = $_GET['id'] ?? null;  
$stmt = $pdo->prepare("SELECT * FROM media WHERE id = ?");
$stmt->execute([$id]);
$value = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
$soort = $value['soort'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($soort == "films") {
        $stmt = $pdo->prepare("UPDATE media set title = ?, released_at = ?, country = ?, length_in_minutes = ?, youtube_trailer_id = ?, summary = ? WHERE id=?");
        $stmt->bindParam(1, $_POST['title']);
        $stmt->bindParam(2, $_POST['released_at']);
        $stmt->bindParam(3, $_POST['country']);
        $stmt->bindParam(4, $_POST['length_in_minutes']);
        $stmt->bindParam(5, $_POST['youtube_trailer_id']);
        $stmt->bindParam(6, $_POST['summary']);
        $stmt->bindParam(7, $value['id']);
        $stmt->execute();
    } elseif ($soort == "series") {
        $stmt = $pdo->prepare("UPDATE media set title = ?, rating = ?, has_won_awards = ?, seasons = ?, country = ?, spoken_in_language = ?, summary = ? WHERE id=?");
        $stmt->bindParam(1, $_POST['title']);
        $stmt->bindParam(2, $_POST['rating']);
        $stmt->bindParam(3, $_POST['has_won_awards']);
        $stmt->bindParam(4, $_POST['seasons']);
        $stmt->bindParam(5, $_POST['country']);
        $stmt->bindParam(6, $_POST['spoken_in_language']);
        $stmt->bindParam(7, $_POST['summary']);
        $stmt->bindParam(8, $value['id']);
        $stmt->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>

</head>

<body>
    <h1><?= $value['title']; ?></h1>
    <form method="POST">
        <table class="edittable">
            <tr>
                <a href="detail.php?id=<?= $id ?>"><button type="button" class="container">terug</button></a>
            </tr>
            <tr>
                <td>
                    <label for="title">Titel:</label>
                    <input type="text" id="title" name="title" value="<?= $value['title']; ?>"><br>
                </td>
            </tr>
            <tr>
                <?php if ($soort == "series") : ?>
                    <td>
                        <label for="rating">Rating:</label>
                        <input type="text" id="rating" name="rating" value="<?= $value['rating']; ?>"><br>
                    </td>
                <?php endif; ?>
            </tr>
            <tr>
                <?php if ($soort == "series") : ?>
                    <td>
                        <label for="has_won_awards">Awards:</label>
                        <input type="number" id="has_won_awards" name="has_won_awards" value="<?= $value['has_won_awards']; ?>"><br>
                    </td>
                <?php endif; ?>
            </tr>
            <tr>
                <?php if ($soort == "series") : ?>
                    <td>
                        <label for="seasons">Season:</label>
                        <input type="text" id="seasons" name="seasons" value="<?= $value['seasons']; ?>"><br>
                    </td>
                <?php endif; ?>
            </tr>
            <tr>
                <?php if ($soort == "series") : ?>
                    <td>
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" value="<?= $value['country']; ?>"><br>
                    </td>
                <?php endif; ?>
            </tr>
            <tr>
                <?php if ($soort == "series") : ?>
                    <td>
                        <label for="spoken_in_language">Taal:</label>
                        <input type="text" id="spoken_in_language" name="spoken_in_language" value="<?= $value['spoken_in_language']; ?>"><br>
                    </td>
                <?php endif; ?>
            </tr>
            <tr>
                <?php if ($soort == "films") : ?>
                    <td>
                        <label for="released_at">datum:</label>
                        <input type="date" id="released_at" name="released_at" value="<?= $value['released_at']; ?>"><br>
                    </td>
                <?php endif; ?>
            </tr>
            <tr>
                <?php if ($soort == "films") : ?>
                    <td>
                        <label for="country">country of origin:</label>
                        <input type="text" id="country" name="country" value="<?= $value['country']; ?>"><br>
                    </td>
                <?php endif; ?>
            </tr>
            <tr>
                <?php if ($soort == "films") : ?>
                    <td>
                        <label for="length_in_minutes">duur:</label>
                        <input type="text" id="length_in_minutes" name="length_in_minutes" value="<?= $value['length_in_minutes']; ?>"><br>
                    </td>
                <?php endif; ?>
            </tr>
            <tr>
                <?php if ($soort == "films") : ?>
                    <td>
                        <label for="youtube_trailer_id">trailer id:</label>
                        <input type="text" id="youtube_trailer_id" name="youtube_trailer_id" value="<?= $value['youtube_trailer_id']; ?>" readonly><br>
                    </td>
                <?php endif; ?>
            </tr>
            <tr>
                <td>
                    <label for="summary">omschrijving:</label>
                    <textarea id="summary" name="summary"><?= $value['summary']; ?></textarea><br>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit">edit</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>