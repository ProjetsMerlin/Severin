<?php
function renderFaq($data) {
?>
<section data-anchor="<?=  $data["anchor"] ?? ""; ?>" class="faq <?= $data['class'] ?? '' ?>">
    <div class="faq-container">
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