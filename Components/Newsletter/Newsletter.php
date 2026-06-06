<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    http_response_code(405);

    echo json_encode([
        'success' => false,
        'message' => 'Méthode non autorisée.'
    ]);

    exit;
}

$email = filter_input( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
if (!$email) {

    echo json_encode([
        'success' => false,
        'message' => 'Adresse email invalide.'
    ]);

    exit;
}

if (!empty($_POST['website'])) {
    echo json_encode([
        'success' => true,
        'message' => 'Spam detected'
    ]);

    exit;
}

$newsletterFile = dirname(__DIR__, 2) . '/admin/newsletter.json';
if (!file_exists($newsletterFile)) {
    file_put_contents( $newsletterFile, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$subscribers = json_decode( file_get_contents($newsletterFile), true) ?? [];
$exists = false;
foreach ($subscribers as $subscriber) {
    if ( isset($subscriber['email']) && strtolower($subscriber['email']) === strtolower($email)) {
        $exists = true;
        break;
    }
}

if ($exists) {
    echo json_encode([
        'success' => false,
        'message' => 'Cette adresse est déjà inscrite.'
    ]);

    exit;
}

$subscribers[] = [ 'email' => $email, 'date' => date('Y-m-d H:i:s') ];

file_put_contents(
    $newsletterFile,
    json_encode(
        $subscribers,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    )
);

/*
|--------------------------------------------------------------------------
| MAILCHIMP SYNC
|--------------------------------------------------------------------------
*/

$mailchimpApiKey = 'YOUR_API_KEY';
$mailchimpListId = 'YOUR_LIST_ID';

if (
    $mailchimpApiKey !== 'YOUR_API_KEY' &&
    $mailchimpListId !== 'YOUR_LIST_ID'
) {

    $dataCenter = substr(
        $mailchimpApiKey,
        strpos($mailchimpApiKey, '-') + 1
    );

    $memberId = md5(strtolower($email));

    $url =
        'https://' .
        $dataCenter .
        '.api.mailchimp.com/3.0/lists/' .
        $mailchimpListId .
        '/members/' .
        $memberId;

    $payload = json_encode([
        'email_address' => $email,
        'status_if_new' => 'subscribed',
        'status' => 'subscribed'
    ]);

    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_USERPWD => 'user:' . $mailchimpApiKey,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json'
        ],
        CURLOPT_POSTFIELDS => $payload
    ]);

    curl_exec($ch);
}

echo json_encode([
    'success' => true,
    'message' => 'Inscription confirmée. Merci !'
]);