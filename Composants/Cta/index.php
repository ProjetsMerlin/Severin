<?php
function renderCta($data)
    {
?>
<section class="cta <?= $data['class'] ?? '' ?>">
    <div class="cta-container">
        <?php if (!empty($data['subtitle'])): ?>
            <div class="cta-subtitle">
                <?= $data['subtitle'] ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($data['title'])): ?>
            <h2 class="cta-title">
                <?= $data['title'] ?>
            </h2>
        <?php endif; ?>
        <?php if (!empty($data['text'])): ?>
            <p class="cta-text">
                <?= $data['text'] ?>
            </p>
        <?php endif; ?>
        <div class="cta-buttons">
            <?php if (!empty($data['primaryButton'])): ?>
                <a
                    href="<?= $data['primaryButton']['link'] ?>"
                    class="cta-button cta-button-primary"
                >
                    <?= $data['primaryButton']['label'] ?>
                </a>
            <?php endif; ?>
            <?php if (!empty($data['secondaryButton'])): ?>
                <a
                    href="<?= $data['secondaryButton']['link'] ?>"
                    class="cta-button cta-button-secondary"
                >
                    <?= $data['secondaryButton']['label'] ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php
    }