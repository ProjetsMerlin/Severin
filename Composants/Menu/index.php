<?php
    function renderMenu($data) {
?>

<header data-anchor="<?=  $data["anchor"] ? slugify($data["anchor"]) : ""; ?>"class="menu <?= $data['class'] ?? '' ?>">
    <div class="menu-container">
        <!-- Logo -->
        <a
            href="<?= $data['logo']['link'] ?? '/' ?>"
            class="menu-logo"
        >
            <img
                loading="lazy"
                src="<?= $data['logo']['image'] ?>"
                alt="<?= $data['logo']['alt'] ?? 'Logo' ?>"
                title="<?= $data['logo']['alt'] ?? 'Logo' ?>"
            >
        </a>

        <!-- Burger -->
        <button
            class="menu-burger"
            aria-label="Ouvrir le menu"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- Navigation -->
        <nav class="menu-nav">
            <ul>
                <?php foreach ($data['links'] as $link): ?>
                    <li>
                        <a href="<?= $link['url'] ?>">
                            <?= $link['label'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</header>
<?php
}