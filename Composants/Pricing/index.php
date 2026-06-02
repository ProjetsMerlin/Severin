<?php
function renderPricing($data)
{
?>
<section data-anchor="<?=  $data["anchor"] ? slugify($data["anchor"]) : ""; ?>" class="pricing <?= $data['class'] ?? '' ?>">
    <div class="pricing-container">
        <?php if (!empty($data['plans'])) : ?>
            <div class="pricing-grid">
                <?php foreach ($data['plans'] as $plan) : ?>
                    <div class="pricing-card <?= !empty($plan['featured']) ? 'pricing-card-featured' : '' ?>">
                        <?php if (!empty($plan['badge'])) : ?>
                            <div class="pricing-badge">
                                <?= $plan['badge'] ?>
                            </div>
                        <?php endif; ?>
                        <h3 class="pricing-plan">
                            <?= $plan['title'] ?>
                        </h3>
                        <div class="pricing-price">
                            <?= $plan['price'] ?>
                        </div>
                        <?php if (!empty($plan['description'])) : ?>
                            <p class="pricing-description">
                                <?= $plan['description'] ?>
                            </p>
                        <?php endif; ?>
                        <?php if (!empty($plan['features'])) : ?>
                            <ul class="pricing-features">
                                <?php foreach ($plan['features'] as $feature) : ?>
                                    <li>
                                        <?= $feature ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <?php if (!empty($plan['button'])) : ?>
                            <a
                                href="<?= $plan['button']['link'] ?>"
                                class="pricing-button"
                            >
                                <?= $plan['button']['label'] ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php
}