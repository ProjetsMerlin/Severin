<?php
session_start();

$ADMIN_LOGIN = 'admin';
$ADMIN_PASSWORD = 'superpassword';

if (isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}

$error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    if (
        $login === $ADMIN_LOGIN &&
        $password === $ADMIN_PASSWORD
    ) {
        $_SESSION['admin'] = true;
        header('Location: index.php');
        exit;
    }
    else {
        $error = true;
    }
}
?>

<!DOCTYPE html>

<html lang="fr-BE">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Severin - Connexion Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>

<div class="login">
    <h1>
        Admin
    </h1>

    <?php if ($error): ?>

        <div class="error">
            Identifiants invalides
        </div>

    <?php endif; ?>

    <form method="POST">
        <input
            type="text"
            name="login"
            placeholder="Login"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Mot de passe"
            required
        >

        <button type="submit">
            Connexion
        </button>

    </form>

</div>

</body>

</html>