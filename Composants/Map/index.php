<?php
function renderMap($data)
    {
?>
<section data-anchor="<?=  $data["anchor"] ? slugify($data["anchor"]) : ""; ?>"class="map <?= $data['class'] ?? '' ?>">
    <div class="map-container">
        <div class="map-embed">
            <iframe
                loading="lazy"
                src="<?= $data['embed'] ?>"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
    </div>
</section>
<?php
    }