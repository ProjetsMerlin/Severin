<?php
function renderBlog($data)
    {
?>
<?php if( isset($_GET["id"])) : ?>
<?php  $data = array_filter( $data['items'], fn($item) => $item['id'] == htmlspecialchars($_GET["id"]) ) ?? null; ?>
<section data-anchor="<?=  $data["anchor"] ? slugify($data["anchor"]) : ""; ?>" class="single <?= $data['class'] ?? '' ?>">
<?php foreach ($data as $data) : ?>
<article>
    <div class="single-container">
        <figure class="single-image">
            <img 
            lazy="loading" 
            src="<?= $data['image'] ?>" 
            alt="<?= $data['title'] ?>"
            title="<?= $data['title'] ?>">
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
</section>
<?php else : ?>
<section data-anchor="<?=  $data["anchor"] ? slugify($data["anchor"]) : ""; ?>" class="blog <?= $data['class'] ?? '' ?>">
    <div class="blog-container">
        <div class="blog-grid">
            <?php foreach ($data['items'] as $item): ?>
            <article class="blog-card">
                <a href="blog/<?= $item['id'] ?>" class="blog-image">
                    <img
                    loading="lazy"
                    src="<?= $item['image'] ?>"
                    alt="<?= $item['title'] ?>"
                    title="<?= $item['title'] ?>"
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
<?php endif; ?>
<?php
    }