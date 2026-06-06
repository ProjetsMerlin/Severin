<?php
function renderIntroduction($data) {
    ?>
<section data-anchor="<?=  $data["anchor"] ? slugify($data["anchor"]) : ""; ?>"class="introduction <?= $data['class'] ?? '' ?>">
    <div class="introduction-container">
     <?php if (!empty($data['subtitle'])): ?>
        <div class="introduction-subtitle">
            <?= $data['subtitle'] ?>
        </div>
        <?php endif; ?>
        <?php if (!empty($data['title'])): ?>
        <h2 class="introduction-title">
            <?= $data['title'] ?>
        </h2>
        <?php endif; ?>
        <?php if (!empty($data['text'])): ?>
        <p class="introduction-text">
            <?= $data['text'] ?>
        </p>
        <?php endif; ?>
    </div>
</section>
    <?php
} 