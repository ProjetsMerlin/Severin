<?php
function renderNewsletter($data)
    {
?>
<section data-anchor="<?=  $data["anchor"] ? slugify($data["anchor"]) : ""; ?>" class="newsletter <?= $data['class'] ?? '' ?>">
    <div class="newsletter-container">
        <h3>
            <span class="color_light">Inscription à notre </span>Newsletter
        </h3>
        <form
            class="newsletter-form"
            method="POST"
            action="<?= $data['action'] ?? '#' ?>"
        >
        <label for="email">Adresse email</label>
            <input
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