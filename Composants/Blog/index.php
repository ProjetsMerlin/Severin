<?php
function renderBlog($data)
    {
?>
<section class="blog <?= $data['class'] ?? '' ?>">
    <div class="blog-container">
        <?php if (!empty($data['subtitle'])): ?>
            <div class="blog-subtitle">
                <?= $data['subtitle'] ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($data['title'])): ?>
            <h2 class="blog-title">
                <?= $data['title'] ?>
            </h2>
        <?php endif; ?>
        <?php if (!empty($data['text'])): ?>
            <p class="blog-text">
                <?= $data['text'] ?>
            </p>
        <?php endif; ?>
        <div class="blog-grid">
            <?php foreach ($data['items'] as $item): ?>
                <article class="blog-card">
                    <a
                        href="article?id=<?= $item['id'] ?>"
                        class="blog-image"
                    >
                        <img
                            src="<?= $item['image'] ?>"
                            alt="<?= $item['title'] ?>"
                        >
                    </a>
                    <div class="blog-content">
                        <div class="blog-date">
                            <?= $item['date'] ?>
                        </div>
                        <h3 class="blog-card-title">
                            <a href="/article?id=<?= $item['id'] ?>">
                                <?= $item['title'] ?>
                            </a>
                        </h3>
                        <div class="blog-description">
                            <?= $item['description'] ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
    }