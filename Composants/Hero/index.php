<?php

function renderHero($data)
{
?>

<section class="hero <?= $data['class'] ?>">

    <div class="hero-image">

        <img
            loading="lazy"
            src="<?= htmlspecialchars($data['image']) ?>"
            alt="<?= htmlspecialchars($data['title']) ?>"
        >

    </div>

    <div class="hero-content">

        <p class="hero-subtitle">
            <?= html_entity_decode($data['subtitle']) ?>
        </p>

        <h3 class="hero-title">
            <?= html_entity_decode($data['title']) ?>
        </h3>

        <p class="hero-text">
            <?= html_entity_decode($data['text']) ?>
        </p>

        <a
            title="<?= htmlspecialchars($data['title']) ?>"
            href="<?= htmlspecialchars($data['button']['link']) ?>"
            class="hero-button"
        >
            <?= html_entity_decode($data['button']['label']) ?>
        </a>

    </div>

</section>

<?php
}
?>