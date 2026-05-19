<?php
function renderMap($data)
    {
?>
<section class="map <?= $data['class'] ?? '' ?>">
    <div class="map-container">
        <div class="map-embed">
            <iframe
                src="<?= $data['embed'] ?>"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
    </div>
</section>
<?php
    }