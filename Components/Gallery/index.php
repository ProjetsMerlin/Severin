<?php
function renderGallery($data)
{
?>
<section <?= !empty($data['anchor']) ? 'id="' . slugify($data['anchor']) . '"' : '' ?>
    class="gallery <?= $data['class'] ?? '' ?>">
    <div class="gallery-container">
        <?php if (!empty($data['items'])) : ?>
        <div class="gallery-grid">
            <?php foreach ($data['items'] as $item) : ?>
            <a href="<?= $item['image'] ?>" class="gallery-item gallery-lightbox" data-gallery="gallery"
                data-title="<?= $item['title'] ?? '' ?>">
                <img src="<?= $item['image'] ?>" alt="<?= $item['title'] ?? '' ?>">
                <?php if (!empty($item['title'])) : ?>
                <div class="gallery-overlay">
                    <div class="gallery-item-title">
                        <?= $item['title'] ?>
                    </div>
                </div>
                <?php endif; ?>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php
}