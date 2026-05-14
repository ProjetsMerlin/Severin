<?php
function renderFooter($data)
    {
?>

<footer class="footer <?= $data['class'] ?? '' ?>">
    <div class="footer-container">
        <!-- Texte -->
        <p class="footer-text">
            <?= $data['text'] ?>
        </p>

        <!-- Réseaux sociaux -->
        <div class="footer-socials">
            <?php foreach ($data['socials'] as $social): ?>
                <a
                    href="<?= $social['url'] ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="<?= $social['label'] ?>"
                >
                    <img
                        src="<?= $social['icon'] ?>"
                        alt="<?= $social['label'] ?>"
                    >
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</footer>
<?php
    }