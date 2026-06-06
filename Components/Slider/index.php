<?php
function renderSlider($data)
{
?>
<section <?= !empty($data['anchor']) ? 'id="' . slugify($data['anchor']) . '"' : '' ?> class="slider <?= $data['class'] ?? '' ?>">
    <div class="slider-track">
        <?php foreach ($data['items'] as $item) : ?>
            <div class="slider-item">
                <img
                    lazy="loading"
                    src="<?= $item['image'] ?>"
                    alt="<?= $item['alt'] ?? '' ?>"
                    title="<?= $item['title'] ?? '' ?>"
                >
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php
}