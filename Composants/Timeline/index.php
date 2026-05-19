<?php
 function renderTimeline($data)
    {
?>
<section data-anchor="<?=  $data["anchor"] ?? ""; ?>" class="timeline <?= $data['class'] ?? '' ?>">
    <div class="timeline-container">
        <div class="timeline-items">
            <?php foreach ($data['items'] as $item): ?>
                <article class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">
                            <?= $item['date'] ?>
                        </div>
                        <h3 class="timeline-item-title">
                            <?= $item['title'] ?>
                        </h3>
                        <div class="timeline-item-text">
                            <?= $item['text'] ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
}