<?php

function custom_error_handler($errno, $errstr, $errfile, $errline)
{
  $error_message = "[" . date("Y-m-d H:i:s") . "] ";
  $error_message .= "Erreur : [$errno] $errstr - Fichier : $errfile - Ligne : $errline\n";
  $log_file = __DIR__ . '/error_log.txt';
  error_log($error_message, 3, $log_file);

  if (ini_get("display_errors")) {
    echo $error_message;
  }

  return false;
}
set_error_handler("custom_error_handler");

register_shutdown_function(function () {
  $error = error_get_last();
  if ($error !== null && ($error['type'] === E_ERROR || $error['type'] === E_PARSE)) {
    custom_error_handler($error['type'], $error['message'], $error['file'], $error['line']);
  }
});

error_reporting(E_ALL);

function renderError404($data)
    {
?>

<section class="error404 <?= $data['class'] ?? '' ?>">
    <div class="error404-container">
        <h1 class="error404-code">
            <?= $data['code'] ?? '404' ?>
        </h1>
        <h2 class="error404-title">
            <?= $data['title'] ?? 'Page introuvable' ?>
        </h2>
        <p class="error404-text">
            <?= $data['text'] ?? 'La page que vous recherchez semble inexistante.' ?>
        </p>
        <a
            href="<?= $data['button']['link'] ?? '' ?>"
            class="error404-button"
        >
            <?= $data['button']['label'] ?? 'Retour accueil' ?>
        </a>
    </div>
</section>
<?php
    }