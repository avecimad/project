<?php

require('db_connectie.php');
session_start();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT id FROM gebruikers WHERE username = ? AND wachtwoord = ?");
    $stmt->execute([$_POST['username'], $_POST['wachtwoord']]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['loggedInUser'] = $user['id'];
        header('Location: index.php');
        exit;
    } else {
        $error = "Foute login.";
    }
}   
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
        <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="form">
    <form method="post">
        <input type="text" name="username" placeholder="Gebruikersnaam" required><br>
        <input type="password" name="wachtwoord" placeholder="Wachtwoord" required><br>
        <button type="submit">Inloggen</button>
    </form>
    </div>
    <?php

    if (!empty($error)) {
        echo "$error";
    }
    ?>
</body>

</html>