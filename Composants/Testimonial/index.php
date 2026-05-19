<?php
function renderTestimonial($data)
    {
?>
<section data-anchor="<?=  $data["anchor"] ? slugify($data["anchor"]) : ""; ?>" class="testimonials <?= $data['class'] ?? '' ?>">
    <div class="testimonials-container">
        <div class="testimonials-grid">
            <?php foreach ($data['items'] as $item): ?>
                <article class="testimonials-card">
                    <div class="testimonials-stars">
                        <?php for ($i = 0; $i < $item['rating']; $i++): ?>
                            <span>★</span>
                        <?php endfor; ?>
                    </div>
                    <div class="testimonials-content">
                        <?= $item['content'] ?>
                    </div>
                    <div class="testimonials-author">
                        <img
                            src="<?= $item['avatar'] ?>"
                            alt="<?= $item['name'] ?>"
                        >
                        <div class="testimonials-infos">
                            <div class="testimonials-name">
                                <?= $item['name'] ?>
                            </div>
                            <div class="testimonials-role">
                                <?= $item['role'] ?>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
}