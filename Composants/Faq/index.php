<?php
function renderFaq($data) {
?>
<section class="faq <?= $data['class'] ?? '' ?>">
    <div class="faq-container">
        <?php if (!empty($data['subtitle'])): ?>
            <div class="faq-subtitle">
                <?= $data['subtitle'] ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($data['title'])): ?>
            <h2 class="faq-title">
                <?= $data['title'] ?>
            </h2>
        <?php endif; ?>
        <?php if (!empty($data['text'])): ?>
            <p class="faq-text">
                <?= $data['text'] ?>
            </p>
        <?php endif; ?>
        <div class="faq-items">
            <?php foreach ($data['items'] as $item): ?>
                <div class="faq-item">
                    <button class="faq-question">
                        <span>
                            <?= $item['question'] ?>
                        </span>
                        <div class="faq-icon">
                            <span></span>
                            <span></span>
                        </div>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <?= $item['answer'] ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
    }