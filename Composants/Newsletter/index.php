<?php
function renderNewsletter($data) {
?>
<section data-anchor="<?=  $data["anchor"] ? slugify($data["anchor"]) : ""; ?>" class="newsletter <?= $data['class'] ?? '' ?>">
    <div class="newsletter-container">
        <h3>
            <?= $data['title'] ?? "" ?>
        </h3>
        <form class="newsletter-form" action="<?= $data['action'] ?? '#' ?>">
            <input type="text" name="website" style="display:none;">
            <label for="email">Adresse email</label>
            <input
                id="email"
                type="email"
                name="email"
                placeholder="<?= $data['placeholder'] ?? 'Votre adresse email' ?>"
                required
                autocomplete="email"
            >
            <button type="submit">
                <?= $data['button'] ?? 'S’inscrire' ?>
            </button>
        </form>
    </div>
</section>
<?php
}