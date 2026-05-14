<?php

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