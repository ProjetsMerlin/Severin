<?php
function renderFooter($data)
    {
?>
<footer data-anchor="<?=  $data["anchor"] ? slugify($data["anchor"]) : ""; ?>" class="footer <?= $data['class'] ?? '' ?>">
    <div class="footer-container">
        <nav class="footer-socials">
            <?php foreach ($data['socials'] as $social): ?>
                <a
                    href="<?= $social['url'] ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="<?= $social['label'] ?>"
                >
                    <img
                        loading="lazy"
                        src="<?= $social['icon'] ?>"
                        alt="<?= $social['label'] ?>"
                        title="<?= $social['label'] ?>"
                    >
                </a>
            <?php endforeach; ?>
        </nav>
        <p class="footer-text">
            <?= $data['text'] ?? ""; ?>
        </p>
    </div>
</footer>
<?php
    }