<?php

require_once('db_connectie.php');
session_start();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$stmt = $pdo->prepare("SELECT * FROM media WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$value = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

if (!isset($_SESSION['loggedInUser'])) {
    header("Location: detail.php?id=$id");
} else {
    session_destroy();
}


?>
<html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>netland</title>

</head>

<body>
    <span class="container"><a href="index.php"><button type="button">terug</button></a>
        <table>
            <?php

            $id = $value['id'];
            $title = $value['title'];
            $rating = $value['rating'];
            $summary = $value['summary'];
            $awards = $value['has_won_awards'];
            $seasons = $value['seasons'];
            $country = $value['country'];
            $taal = $value['spoken_in_language'];
            $trailer = $value['youtube_trailer_id'];
            $duur = $value['length_in_minutes'];
            $datum = $value['released_at'];
            $soort = $value['soort'];

            if ($soort == "series") {
                echo "<tr><td class='text' colspan='2'>$title</td></tr>";
                echo "<tr><td class='text'>awards</td><td class='number'>$awards</td></tr>";
                echo "<tr><td class='text'>seasons</td><td class='number'>$seasons</td></tr>";
                echo "<tr><td class='text'>country</td><td class='number'>$country</td></tr>";
                echo "<tr><td class='text'>language</td><td class='number'>$taal</td></tr>";
                echo "<tr><td class='text'>rating</td><td class='number'>$rating</td></tr>";
                echo "<tr><td colspan='2' class = 'text aanpassen'><a href='edit.php?id=$id'> aanpassen</a></td></tr>";
            } else {
                echo "<tr><td class='text' colspan='2'>$title</td></tr>";
                echo "<tr> <td class='text'>informatie</td><td class='text'>informatie</td></tr>";
                echo "<tr><td class='text'>datum van uitkomst</td><td class='number'>$datum</td></tr>";
                echo "<tr><td class='text'>land van uitkomst</td><td class='text'>$country</td></tr>";
                echo "<tr><td class='text'>duur</td><td class='number'>$duur</td></tr>";
                echo "<tr><td class='text'>trailer id</td><td class='text'>$trailer</td></tr>";
                echo "<tr><td colspan='4' class = 'text aanpassen'><a href='edit.php?id=$id'> aanpassen</a></td></tr>";
            }
            ?>
        </table>
    </span></span>
    <h3>omschrijving</h3>
    <div id='summary'>
        <p><?php echo "$summary"; ?></p>
    </div>

</body>

</html>