<div class="jsv-photo-sequence" aria-label="Example photos of the same iPhone from four different angles">
    <?php foreach ([11, 29, 47, 65] as $frame) : ?>
        <figure>
            <img src="<?= esc_url(plugins_url('admin/img/iphone-gold-' . $frame . '.png', JSV360_MAIN_URL)) ?>"
                 alt="<?= esc_attr('Gold iPhone, photo ' . $frame . ' of 72') ?>" width="240" height="320" loading="lazy">
            <figcaption><code><?= esc_html('iphone-gold-' . $frame . '.png') ?></code></figcaption>
        </figure>
    <?php endforeach; ?>
</div>
<p class="description">Four sample angles from a 72-photo sequence. The number in each filename indicates its position. Use the complete sequence, including the photos between these examples.</p>
