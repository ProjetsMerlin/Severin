<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['page']) && $_GET['page'] === 'logout') {
    session_destroy();
    header('Location: login.php');
    exit;
}

$jsonPath = __DIR__ . '/data.json';
$json = file_get_contents($jsonPath);
?>

<!DOCTYPE html>

<html lang="fr-BE">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Severin - Admin JSON Editor</title>

    <!-- JSON Editor -->
    <link href="https://cdn.jsdelivr.net/npm/jsoneditor/dist/jsoneditor.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <div class="topbar">
        <h1>
            Severin Data
        </h1>

        <div>
            <a class="btn" href="../">
                Home
            </a>
            <a class="btn" href="?page=logout">
                Log out    
            </a>
            <button id="save">
                Sauvegarder
            </button>
            <span class="status" id="status"></span>
        </div>
    </div>

    <div id="editor"></div>

    <!-- JSON Editor -->
    <script src="https://cdn.jsdelivr.net/npm/jsoneditor/dist/jsoneditor.min.js"></script>

    <script>
    const container = document.getElementById('editor');

    const editor =
        new JSONEditor(container, {

            mode: 'tree',

            modes: [
                'tree',
                'code',
                'form',
                'text'
            ]
        });

    const data = <?= $json ?>;

    editor.set(data);

    document
        .getElementById('save')
        .addEventListener('click', async () => {

            const status = document.getElementById('status');

            status.innerHTML = 'Sauvegarde...';

            try {
                const json = editor.get();

                const response =
                    await fetch('save.php', {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json'
                        },

                        body: JSON.stringify(json)
                    });

                const result = await response.json();

                if (result.success) {
                    status.innerHTML = '✅ Sauvegardé';
                }
                else {
                    status.innerHTML = '❌ Erreur';
                }
            }
            catch (error) {
                console.error(error);
                status.innerHTML = '❌ JSON invalide';
            }
        });
    </script>

</body>

</html>