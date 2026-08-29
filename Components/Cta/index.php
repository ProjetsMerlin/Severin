<?php
function renderCta(Array $data)
    {
?>
<section data-anchor="<?=  $data["anchor"] ? slugify($data["anchor"]) : ""; ?>" class="cta <?= $data['class'] ?? '' ?>">
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
            <div class="cta-text">
                <?= $data['text'] ?>
            </div>
        <?php endif; ?>
        <div class="cta-buttons">
            <?php if (!empty($data['primarybutton'])): ?>
                <a
                    target="<?php $data['primarybutton']['target'] !== "_self" ? print($data['primarybutton']['target']) : print("_self") ?>"
                    href="<?= $data['primarybutton']['url'] ?>"
                    class="cta-button cta-button-primary"
                >
                    <?= $data['primarybutton']['title'] ?>
                </a>
            <?php endif; ?>
            <?php if (!empty($data['secondarybutton'])): ?>
                <a
                    target="<?php $data['secondarybutton']['target'] !== "_self" ? print($data['secondarybutton']['target']) : print("_self") ?>"
                    href="<?= $data['secondarybutton']['url'] ?>"
                    class="cta-button cta-button-secondary"
                >
                    <?= $data['secondarybutton']['title'] ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php
    }