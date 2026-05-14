<?php
function renderMap($data)
    {
?>
<section class="map <?= $data['class'] ?? '' ?>">
    <div class="map-container">
        <?php if (!empty($data['subtitle'])): ?>
            <div class="map-subtitle">
                <?= $data['subtitle'] ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($data['title'])): ?>
            <h2 class="map-title">
                <?= $data['title'] ?>
            </h2>
        <?php endif; ?>
        <?php if (!empty($data['text'])): ?>
            <div class="map-text">
                <?= $data['text'] ?>
            </div>
        <?php endif; ?>
        <div class="map-embed">
            <iframe
                src="<?= $data['embed'] ?>"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
    </div>
</section>
<?php
    }