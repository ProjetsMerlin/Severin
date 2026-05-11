<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

header('Content-Type: application/json');

$jsonPath =__DIR__ . '/data.json';

$json = file_get_contents('php://input');

$data = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {

    http_response_code(400);

    echo json_encode([
        'success' => false,
        'message' => 'JSON invalide'
    ]);

    exit;
}

$backupDir = __DIR__ . '/backup';

if (!is_dir($backupDir)) {
    mkdir($backupDir, 0777, true);
}

copy(
    $jsonPath,
    $backupDir . '/data-' . date('Y-m-d-H-i-s') . '.json'
);

$result =
    file_put_contents(
        $jsonPath,

        json_encode(

            $data,
            JSON_PRETTY_PRINT |
            JSON_UNESCAPED_UNICODE |
            JSON_UNESCAPED_SLASHES
        )
    );

if ($result !== false) {
    echo json_encode([
        'success' => true
    ]);
}
else {
    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'Erreur sauvegarde'
    ]);
}