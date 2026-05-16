<?php
 function renderTimeline($data)
    {
?>
<section class="timeline <?= $data['class'] ?? '' ?>">
    <div class="timeline-container">
        <?php if (!empty($data['subtitle'])): ?>
            <div class="timeline-subtitle">
                <?= $data['subtitle'] ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($data['title'])): ?>
            <h2 class="timeline-title">
                <?= $data['title'] ?>
            </h2>
        <?php endif; ?>
        <?php if (!empty($data['text'])): ?>
            <div class="timeline-text">
                <?= $data['text'] ?>
            </div>
        <?php endif; ?>
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