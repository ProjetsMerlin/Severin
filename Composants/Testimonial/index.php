<?php
function renderTestimonial($data)
    {
?>
<section class="testimonials <?= $data['class'] ?? '' ?>">
    <div class="testimonials-container">
        <?php if (!empty($data['subtitle'])): ?>
            <div class="testimonials-subtitle">
                <?= $data['subtitle'] ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($data['title'])): ?>
            <h2 class="testimonials-title">
                <?= $data['title'] ?>
            </h2>
        <?php endif; ?>
        <?php if (!empty($data['text'])): ?>
            <p class="testimonials-text">
                <?= $data['text'] ?>
            </p>
        <?php endif; ?>
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