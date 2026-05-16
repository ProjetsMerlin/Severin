<?php
function renderBlog($data)
    {
?>
<?php if( isset($_GET["id"])) : ?>
<?php
    $data = array_filter(
            $data['items'],
            fn($item) =>
                $item['id'] == htmlspecialchars($_GET["id"])
        ) ?? null;
?>
<?php foreach ($data as $data) : ?>
<article class="single <?= $data['class'] ?? '' ?>">
    <div class="single-container">
        <figure class="single-image">
            <img src="<?= $data['image'] ?>" alt="<?= $data['title'] ?>" lazy="loading" title="<?= $data['title'] ?>">
        </figure>
        <div class="single-content">
            <date class="single-date">
                <?= $data['date'] ?>
            </date>
            <h1 class="single-title">
                <?= $data['title'] ?>
            </h1>
            <div class="single-text">
                <?= $data['content'] ?>
            </div>
        </div>
    </div>
</article>
<?php endforeach; ?>
<?php else : ?>
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
                <a href="blog/<?= $item['id'] ?>" class="blog-image">
                    <img src="<?= $item['image'] ?>" alt="<?= $item['title'] ?>">
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
<?php endif; ?>
<?php
    }