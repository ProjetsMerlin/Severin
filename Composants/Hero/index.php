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
            <?= htmlspecialchars($data['subtitle']) ?>
        </p>

        <h1>
            <?= htmlspecialchars($data['title']) ?>
        </h1>

        <p class="hero-text">
            <?= htmlspecialchars($data['text']) ?>
        </p>

        <a
            title="<?= htmlspecialchars($data['title']) ?>"
            href="<?= htmlspecialchars($data['button']['link']) ?>"
            class="hero-button"
        >
            <?= htmlspecialchars($data['button']['label']) ?>
        </a>

    </div>

</section>

<?php
}
?>